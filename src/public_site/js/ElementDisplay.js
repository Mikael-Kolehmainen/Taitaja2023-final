/*
  This is a class which has a static function that makes it easy and makes it
  cleaner to change an elements display. The function takes in the element id
  and what display it should be changed to.
*/
class ElementDisplay
{
  /**
   * @param {string} elementId
   * @param {string} display
   */
  static change(elementId, display)
  {
    document.getElementById(elementId).style.display = display;
  }
}
