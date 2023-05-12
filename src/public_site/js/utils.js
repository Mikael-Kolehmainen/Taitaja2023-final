/**
 * This function removes all children of an HTML element.
 * @param {HTMLElement} parent
 */
const removeChilds = (parent) => {
  while (parent.lastChild) {
    parent.removeChild(parent.lastChild);
  }
};

/**
 * This function returns a random integer from a range.
 * @param {int} max
 * @returns {int}
 */
const getRandomInt = (max) => {
  return Math.floor(Math.random() * max);
};
