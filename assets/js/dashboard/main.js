// assets/js/dashboard/main.js

document.addEventListener("DOMContentLoaded", function() {
    // Initialize your page
    loadPage('dashboard_entry');
  
    // Single event listener for all menu items
    document.getElementById("dashboard-menu").addEventListener("click", function(event) {
      const targetElement = event.target;
      
      if (targetElement.tagName === 'LI') {
        const pageName = targetElement.getAttribute("data-page-name");
        loadPage(pageName);
      }
    });
  });
  
  function loadPage(pageName) {
    const dashboardContent = document.getElementById("dashboard-content");
    
    fetch(`../assets/js/dashboard/views/${pageName}.html`)
      .then(response => response.text())
      .then(html => {
        dashboardContent.innerHTML = html;
        
        // Dynamically load the script
        const script = document.createElement('script');
        script.src = `../assets/js/dashboard/pages/${pageName}.js`;
        script.type = 'text/javascript';
        dashboardContent.appendChild(script);
      })
      .catch(error => {
        console.warn(error);
        dashboardContent.innerHTML = '<h1>Page Not Found</h1>';
      });
}