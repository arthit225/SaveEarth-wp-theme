<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics;

use RebelCode\Iris\Engine;
use RebelCode\Iris\Fetcher\FetchQuery;
use RebelCode\Spotlight\Instagram\Config\ConfigEntry;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaItem;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\UserSource;
use RebelCode\Spotlight\Instagram\IgApi\IgAccount;
use RebelCode\Spotlight\Instagram\IgApi\IgApiClient;
use RebelCode\Spotlight\Instagram\PostTypes\AccountPostType;
use RebelCode\Spotlight\Instagram\PostTypes\MediaPostType;
use RebelCode\Spotlight\Instagram\Wp\PostType;
use Throwable;
use wpdb;

class AnalyticsCollector
{
    /** @var wpdb */
    protected $wpdb;

    /** @var AnalyticsTables */
    protected $tables;

    /** @var IgApiClient */
    protected $apiClient;

    /** @var Engine */
    protected $engine;

    /** @var PostType */
    protected $mediaCpt;

    /** @var PostType */
    protected $accountsCpt;

    /** @var ConfigEntry */
    protected $lastUpdateCfg;

    /**
     * Constructor.
     *
     * @param IgApiClient $apiClient Used to get the number of followers from the account information.
     * @param Engine $engine Used to fetch account posts to count likes and comments.
     * @param AnalyticsTables $tables The analytics table manager.
     * @param PostType $mediaCpt The media post type.
     * @param PostType $accountsCpt The accounts post type.
     * @param ConfigEntry $lastUpdateCfg The config entry that stores when analytics were last collected.
     */
    public function __construct(
        wpdb $wpdb,
        AnalyticsTables $tables,
        IgApiClient $apiClient,
        Engine $engine,
        PostType $mediaCpt,
        PostType $accountsCpt,
        ConfigEntry $lastUpdateCfg
    ) {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->tables = $tables;
        $this->apiClient = $apiClient;
        $this->engine = $engine;
        $this->mediaCpt = $mediaCpt;
        $this->accountsCpt = $accountsCpt;
        $this->lastUpdateCfg = $lastUpdateCfg;
    }

    /** Collects all analytics */
    public function collect(): void
    {
        // Set the PHP timezone to be WordPress' settings timezone
        date_default_timezone_set(wp_timezone()->getName());

        foreach ($this->accountsCpt->query() as $accountPost) {
            try {
                $account = AccountPostType::fromWpPost($accountPost);
                if ($account->getUser()->type === 'DEVELOPER') {
                    continue;
                }

                [$totalLikes, $totalComments] = $this->collectPostAnalytics($account);
                $this->collectAccountAnalytics($account, $totalLikes, $totalComments);
            } catch (Throwable $e) {
                continue;
            }
        }

        $this->lastUpdateCfg->setValue(time());
    }

    /** Collects analytics for accounts. */
    public function collectAccountAnalytics(IgAccount $account, int $totalLikes, int $totalComments): void
    {
        $table = $this->tables->accounts();
        $accountInfo = $this->apiClient->getAccountInfo($account);
        $accountUser = $accountInfo->getUser();

        $record = [
            'date' => date('Y-m-d'),
            'account' => $accountUser->username,
            'followers' => $accountInfo->user->followersCount,
            'likes' => $totalLikes,
            'comments' => $totalComments,
        ];

        $numRows = $this->wpdb->query(
            $table->insert([$record])
                  ->onDuplicateKey([
                      'followers' => $table->column('followers')->fn('VALUES'),
                      'likes' => $table->column('likes')->fn('VALUES'),
                      'comments' => $table->column('comments')->fn('VALUES'),
                  ])
        );

        if (!is_int($numRows)) {
            throw new RuntimeException($this->wpdb->error);
        }
    }

    /** Collects analytics for posts. */
    public function collectPostAnalytics(IgAccount $account): array
    {
        $records = [];
        $totalLikes = 0;
        $totalComments = 0;
        $today = date('Y-m-d');
        $cursor = null;
        $table = $this->tables->posts();
        $source = UserSource::create(
            $account->user->username,
            $account->user->type
        );

        do {
            set_time_limit(120);
            $fetchQuery = new FetchQuery($source, $cursor, 50);
            $result = $this->engine->fetch($fetchQuery);

            foreach ($result->items as $item) {
                $id = $item->data[MediaItem::MEDIA_ID];
                $type = $item->data[MediaItem::MEDIA_TYPE];
                $numLikes = $item->data[MediaItem::LIKES_COUNT];
                $numComments = $item->data[MediaItem::COMMENTS_COUNT];

                $records[] = [
                    'date' => $today,
                    'post' => $id,
                    'type' => $type,
                    'account' => $account->user->username,
                    'likes' => $numLikes,
                    'comments' => $numComments,
                ];

                $totalLikes += $numLikes;
                $totalComments += $numComments;
            }

            $cursor = $result->nextCursor;
        } while ($cursor !== null);

        $this->wpdb->query(
            $table->insert($records)
                  ->onDuplicateKey([
                      'likes' => $table->column('likes')->fn('VALUES'),
                      'comments' => $table->column('comments')->fn('VALUES'),
                  ])
        );

        return [$totalLikes, $totalComments];
    }

    /** @return bool Whether the click was recorded in the database. */
    public function addPostClick(string $postId): bool
    {
        $mediaPost = MediaPostType::getByInstagramId($this->mediaCpt, $postId);
        if ($mediaPost === null) {
            return false;
        }

        $account = $mediaPost->{MediaPostType::USERNAME};
        $type = $mediaPost->{MediaPostType::TYPE};
        $record = [
            'date' => date('Y-m-d'),
            'account' => $account,
            'post' => $postId,
            'type' => $type,
            'clicks' => 1,
        ];

        $table = $this->tables->engagement();

        $numRows = $this->wpdb->query(
            $table->insert([$record])
                  ->onDuplicateKey([
                      'clicks' => $table->column('clicks')->plus(1),
                  ])
        );

        return $numRows > 0;
    }

    public function addPromoClick(string $postId, string $source, int $instance)
    {
        $mediaPost = MediaPostType::getByInstagramId($this->mediaCpt, $postId);
        if ($mediaPost === null) {
            return false;
        }

        $account = $mediaPost->{MediaPostType::USERNAME};
        $type = $mediaPost->{MediaPostType::TYPE};
        $record = [
            'date' => date('Y-m-d'),
            'account' => $account,
            'post' => $postId,
            'type' => $type,
            'source' => $source,
            'instance' => $instance,
            'clicks' => 1,
        ];

        $table = $this->tables->promoAnalytics();

        $numRows = $this->wpdb->query(
            $table->insert([$record])
                  ->onDuplicateKey([
                      'clicks' => $table->column('clicks')->plus(1),
                  ])
        );

        return $numRows > 0;
    }
}
