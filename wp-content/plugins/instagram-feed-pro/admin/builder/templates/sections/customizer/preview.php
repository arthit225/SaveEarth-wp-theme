<div class="sb-customizer-preview" :data-preview-device="customizerScreens.previewScreen">
	<?php
		/**
		 * CFF Admin Notices
		 *
		 * @since 4.0
		 */
		// do_action('sbi_admin_notices');

		$feed_id = ! empty( $_GET['feed_id'] ) ? (int)$_GET['feed_id'] : 0;
	?>
	<div class="sb-preview-ctn sb-tr-2">
		<div class="sb-preview-top-chooser sbi-fb-fs">
			<strong :class="getModerationShoppableMode == true ? 'sbi-moderate-heading' :''" v-html="getModerationShoppableMode == false ? genericText.preview : ( svgIcons['eyePreview'] + '' + (customizerScreens.activeSection === 'settings_shoppable_feed' ? genericText.shoppableModePreview : genericText.moderationModePreview) )"></strong>
			<div class="sb-preview-chooser" v-if="getModerationShoppableMode == false">
				<button class="sb-preview-chooser-btn" v-for="device in previewScreens" v-bind:class="'sb-' + device" v-html="svgIcons[device]" @click.prevent.default="switchCustomizerPreviewDevice(device)" :data-active="customizerScreens.previewScreen == device"></button>
			</div>
			<div class="sb-moderationmoder-filter" v-if="getModerationShoppableMode == true && customizerScreens.activeSection == 'settings_filters_moderation'">
				<div class="sb-moderationmoder-filter-btn" :data-active="moderationShoppableShowSelected == 0 ? 'true' : 'false'" @click.prevent.default="moderationModeShowSelected(0)">{{genericText.showAll}}</div>
				<div class="sb-moderationmoder-filter-btn" :data-active="moderationShoppableShowSelected == 1 ? 'true' : 'false'" @click.prevent.default="moderationModeShowSelected(1)">{{genericText.showSelected}}</div>
			</div>
		</div>

		<div class="sbi-preview-ctn sbi-fb-fs" :data-boxshadow="valueIsEnabled(customizerFeedData.settings.boxshadow) && customizerFeedData.settings.poststyle === 'boxed'">
			<div>
				<component :is="{template}"></component>
			</div>
			<?php
				include_once SBI_BUILDER_DIR . 'templates/preview/light-box.php';
			?>
		</div>

		<div class="sbi-moderation-pagination sbi-fb-fs" v-if="getModerationShoppableMode">
			<div class="sbi-moderation-pagination-info">
				 {{(moderationShoppableModeOffset * 20) + 1}} - {{(moderationShoppableModeOffset + 1) * 20}} of {{(moderationShoppableModeOffsetLast + 1) * 20}}+ posts
			</div>
			<div class="sbi-moderation-pagination-btns">
				<div class="sb-btn sb-btn-grey" :disabled="getModerationShoppableModeOffset && ! getModerationShoppableisLoading ? false : true" @click.prevent.default="getModerationShoppableModeOffset ? moderationModePagination('first') : false">&#8249;&#8249;</div>
				<div class="sb-btn sb-btn-grey" :disabled="getModerationShoppableModeOffset && ! getModerationShoppableisLoading ? false : true" @click.prevent.default="getModerationShoppableModeOffset ? moderationModePagination('previous') : false">&#8249;</div>
				<span class="sbi-moderation-pagination-page">{{moderationShoppableModeOffset + 1}}</span>
				<div class="sb-btn sb-btn-grey" :disabled="shouldPaginateNext && ! getModerationShoppableisLoading ? false : true" @click.prevent.default="shouldPaginateNext ? moderationModePagination('next') : false">&#8250;</div>
				<div class="sb-btn sb-btn-grey" :disabled="shouldPaginateNext && ! getModerationShoppableisLoading ? false : true" @click.prevent.default="shouldPaginateNext ? moderationModePagination('last') : false">&#8250;&#8250;</div>
			</div>
		</div>

	</div>
	<sbi-dummy-lightbox-component :dummy-light-box-screen="dummyLightBoxScreen" :customizer-feed-data="customizerFeedData"></sbi-dummy-lightbox-component>

</div>


