/*
  This is a class which makes it easy to create & remove CSS stylesheets with JS,
  on instantiation the class takes in the class name of the <style> element and
  the CSS content.

  There's two functions: createStyle & removeStyle, respectively one creates
  the stylesheet and the other one deletes it.
*/
class Style
{
  /**
   * @param {string} styleClassName
   * @param {string} styleSheetContent
   */
  constructor(styleClassName, styleSheetContent = "")
  {
    this.styleClassName = styleClassName;
    this.styleSheetContent = styleSheetContent;
  }

  createStyle()
  {
    let head = document.head;
    let style = document.createElement('style');

    style.classList.add(this.styleClassName);
    style.appendChild(document.createTextNode(this.styleSheetContent));

    head.appendChild(style);
  }

  removeStyle()
  {
    let styles = document.getElementsByClassName(this.styleClassName);

    for (let i = 0; i < styles.length; i++) {
      styles[i].remove();
    }
  }
}
