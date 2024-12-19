function toggleBodyClass(direction, classSelector, hash) {
  if (direction == "close") {
    document.body.classList.remove(classSelector);
  } else if (direction == "open") {
    document.body.classList.add(classSelector);
  } else {
    document.body.classList.toggle(classSelector);
  }
  if (hash) {
    window.location.hash = hash;
  }
  window.toggleBodyClass = toggleBodyClass;
}

export default toggleBodyClass;
