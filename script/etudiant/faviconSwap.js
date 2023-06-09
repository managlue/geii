function toggleIcon() {
    var icon = document.getElementById('icon');
    
    if (icon.classList.contains('fa-angle-double-left')) {
      icon.classList.remove('fa-angle-double-left');
      icon.classList.add('fa-angle-double-right');
    } else {
      icon.classList.remove('fa-angle-double-right');
      icon.classList.add('fa-angle-double-left');
    }
}
  