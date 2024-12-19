<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Atlas\Expression\UnaryExpr;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsTables;
use RebelCode\Spotlight\Instagram\RestApi\EndPoints\AbstractEndpointHandler;
use Throwable;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use wpdb;

class ManualAnalyticsEndPoint extends AbstractEndpointHandler
{
    /** @var wpdb */
    protected $wpdb;

    /** @var AnalyticsTables */
    protected $tables;

    /** Constructor. */
    public function __construct(wpdb $wpdb, AnalyticsTables $tables)
    {
        $this->wpdb = $wpdb;
        $this->tables = $tables;
    }

    protected function handle(WP_REST_Request $request)
    {
        $action = $request->get_param('action');

        switch ($action) {
            case 'followers':
                $this->doFollowers($request);
                break;
            case 'likes_comments':
                $this->doLikesComments($request);
                break;
        }

        return new WP_REST_Response([]);
    }

    protected function doFollowers(WP_REST_Request $request)
    {
        $username = $request->get_param('username');
        $data = $request->get_param('data');
        $records = [];

        foreach ($data as $date => $numFollowers) {
            $records[] = [
                'date' => date('Y-m-d H:i:s', strtotime($date)),
                'account' => $username,
                'followers' => $numFollowers,
            ];
        }

        $numRows = $this->wpdb->query(
            $this->tables->accounts()->insert($records, [
                'followers' => $this->tables->accounts()->column('followers')->fn('VALUES'),
            ])
        );

        if (!is_int($numRows)) {
            throw new RuntimeException($this->wpdb->error);
        }
    }

    protected function doLikesComments(WP_REST_Request $request)
    {
        $username = $request->get_param('username');
        $post = $request->get_param('post');
        $type = $request->get_param('type');
        $likesData = $request->get_param('likes');
        $commentsData = $request->get_param('comments');

        $records = [];

        foreach ($likesData as $date => $numLikes) {
            $dateStr = date('Y-m-d', strtotime($date));
            $records[$dateStr] = [
                'date' => $dateStr,
                'account' => $username,
                'post' => $post,
                'type' => $type,
                'likes' => $numLikes,
                'comments' => $commentsData[$date] ?? 0,
            ];
        }

        foreach ($commentsData as $date => $numComments) {
            $dateStr = date('Y-m-d', strtotime($date));
            if (!array_key_exists($dateStr, $records)) {
                $records[] = [
                    'date' => $dateStr,
                    'account' => $username,
                    'post' => $post,
                    'type' => $type,
                    'likes' => 0,
                    'comments' => $numComments,
                ];
            }
        }

        $numRows = $this->wpdb->query(
            $this->tables->posts()->insert(array_values($records), [
                'likes' => $this->tables->posts()->column('likes')->fn('VALUES'),
                'comments' => $this->tables->posts()->column('comments')->fn('VALUES'),
            ])
        );

        if (!is_int($numRows)) {
            throw new RuntimeException($this->wpdb->error);
        }
    }
}
