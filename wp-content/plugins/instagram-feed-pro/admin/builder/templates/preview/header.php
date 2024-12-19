<section id="sbi-header-section" class="sbi-preview-header-ctn sbi-fb-fs sbi-preview-section" :data-dimmed="!isSectionHighLighted('header')" v-if="valueIsEnabled(customizerFeedData.settings.showheader) && customizerFeedData.header && sourcesList.length">
	<!--Text header-->
	<div class="sbi-preview-header-text sbi-fb-fs" v-if="customizerFeedData.settings.headerstyle == 'text'">
		<h3 class="sbi-preview-header-text-h sbi-fb-fs">
			<span class="sbi-header-text" v-html="customizerFeedData.settings.headertext"></span>
		</h3>
	</div>

</section>

<svg width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="sbi-screenreader" role="img" aria-labelledby="metaSVGid metaSVGdesc"><title id="metaSVGid">Comments Box SVG icons</title><desc id="metaSVGdesc">Used for the like, share, comment, and reaction icons</desc><defs><linearGradient id="angryGrad" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#f9ae9e"></stop><stop offset="70%" stop-color="#ffe7a4"></stop></linearGradient><linearGradient id="likeGrad"><stop offset="25%" stop-color="rgba(0,0,0,0.05)"></stop><stop offset="26%" stop-color="rgba(255,255,255,0.7)"></stop></linearGradient><linearGradient id="likeGradHover"><stop offset="25%" stop-color="#a3caff"></stop><stop offset="26%" stop-color="#fff"></stop></linearGradient><linearGradient id="likeGradDark"><stop offset="25%" stop-color="rgba(255,255,255,0.5)"></stop><stop offset="26%" stop-color="rgba(255,255,255,0.7)"></stop></linearGradient></defs></svg>