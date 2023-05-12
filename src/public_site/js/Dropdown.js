/*
  This is a class which has a static function that makes it easy and avoids code
  repetition to connect an HTML element to another HTML element, connects them so
  that when an element is clicked another elements display is change between 'none'
  and 'block'. For example, a dropdown button and dropdown content.
*/
class Dropdown
{
  /**
   * @param {string} dropDownBtnId
   * @param {string} dropdownId
   */
  static connectElements(dropDownBtnId, dropdownId)
  {
    let dropdownBtn = document.getElementById(dropDownBtnId);
    let dropdown = document.getElementById(dropdownId);

    dropdownBtn.addEventListener("click", function() {
      if (dropdown.style.display == "block") {
        ElementDisplay.change(dropdownId, "none");
      } else {
        ElementDisplay.change(dropdownId, "block");
      }
    });
  }
}
