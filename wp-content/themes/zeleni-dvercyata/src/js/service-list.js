const serviceList = () => {
  const borderColors = ['309B19', 'E63C15', 'F2B03C', '66A1D0', '945E9D', 'A7C62C', 'E7699E', 'FBE700', '2D9218', '6098C5', 'D93914'];
  const listItems = document.querySelectorAll('.service-list > li');
  for (let i = 0; i <= listItems.length - 1; i += 1) {
    listItems[i].style.borderBottom = `4px solid #${borderColors[i]}`;
  }
};

export default serviceList;
