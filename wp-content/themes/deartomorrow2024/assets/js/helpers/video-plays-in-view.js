const videoPlaysInView = document.querySelectorAll(".js-video-plays-in-view");
videoPlaysInView.forEach((video) => {
  // We can only control playback without insteraction if video is muted
  video.muted = true;
  // Play is a promise so we need to check we have it
  let playPromise = video.play();
  if (playPromise !== undefined) {
    playPromise.then((_) => {
      let observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.intersectionRatio <= 0.1 && !video.paused) {
              video.pause();
              // console.log("video pause");
            } else if (video.paused) {
              // set to half a second so that if it goes out of view again doesnt hammer the bandwidth
              setTimeout(function () {
                video.play();
              }, 500);

              // console.log("video play");
            }
          });
        },
        { threshold: 0.1 }
      );

      observer.observe(video);
    });
  }
});
