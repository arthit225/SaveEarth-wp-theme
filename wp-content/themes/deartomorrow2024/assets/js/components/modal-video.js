export default function initializeVideoModal() {
  document.querySelectorAll(".lvideo").forEach((d) => d.addEventListener("click", playVideos));
}

function playVideos(e) {
  lvideo(e.currentTarget.dataset.embedcode);

  document.body.classList.add("lvideo-active");

  var lvideoWrap = document.createElement("DIV");
  lvideoWrap.setAttribute("id", "lvideo-wrap");
  document.body.appendChild(lvideoWrap);

  const wrapper = document.getElementById("lvideo-wrap");
  wrapper.classList.add("active");

  const startModal = `<span class="lvideo-overlay"></span> <div class="lvideo-container">`;
  const finishModal = `</div><button class="lvideo-close">
  <svg width="15" height="14" viewBox="0 0 15 14" xmlns="http://www.w3.org/2000/svg">
    <rect x="2" y="0.020874" width="17" height="2.4" rx="1.2" transform="rotate(45 2 0.020874)"/>
    <rect y="12.0209" width="17" height="2.4" rx="1.2" transform="rotate(-45 0 12.0209)"/>
    </svg>
  </button>`;

  document.getElementById(
    "lvideo-wrap"
  ).innerHTML = `${startModal}${this.dataset.embedcode}${finishModal}`;

  document.querySelectorAll(".lvideo-overlay, .lvideo-close").forEach((d) => d.addEventListener("click", lvideoClose));
}

// CLOSE MODAL LVIDEO
function lvideoClose() {
  document.body.classList.remove("lvideo-active");

  const wrapper = document.getElementById("lvideo-wrap");
  wrapper.parentNode.removeChild(wrapper);
};

// LAUNCH
function lvideo(){}
  