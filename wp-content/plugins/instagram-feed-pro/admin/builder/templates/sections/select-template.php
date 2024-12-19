<div class="sbi-fb-types-ctn sbi-fb-fs sb-box-shadow" v-if="viewsActive.selectedFeedSection == 'selectTemplate'">
    <div class="sbi-fb-types sbi-fb-fs">
        <h4>{{selectFeedTemplateScreen.feedTemplateHeading}}</h4>
        <p class="sb-caption sb-lighter">{{selectFeedTemplateScreen.feedTemplateDescription}}</p>

        <div class="sbi-fb-templates-list">
            <div class="sbi-fb-type-el" v-for="(feedTemplateEl, feedTemplateIn) in feedTemplates" :data-active="selectedFeedTemplate === feedTemplateEl.type" @click.prevent.default="chooseFeedTemplate(feedTemplateEl)">
                <div class="sbi-fb-type-el-img sbi-fb-fs" v-html="svgIcons[feedTemplateEl.icon]"></div>
                <div class="sbi-fb-type-el-info sbi-fb-fs">
                    <p class="sb-small-p sb-bold sb-dark-text" v-html="getFeedTemplateElTitle(feedTemplateEl)"></p>
                </div>
            </div>
        </div>
    </div>
</div>
