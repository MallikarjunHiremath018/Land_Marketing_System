// Simple mock authentication
const mockCredentials = {
    username: "admin",
    password: "1234"
};

// Check if user is logged in
document.addEventListener("DOMContentLoaded", () => {
    const isLoggedIn = localStorage.getItem("isLoggedIn");
    const authLink = document.getElementById("authLink");
    
    if (isLoggedIn) {
        authLink.innerHTML = '<a href="#" id="logout">Logout</a>';
        document.getElementById("logout").addEventListener("click", () => {
            localStorage.removeItem("isLoggedIn");
            window.location.href = "index.html";
        });
    }
    
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            
            if (username === mockCredentials.username && password === mockCredentials.password) {
                localStorage.setItem("isLoggedIn", true);
                alert("Login successful!");
                window.location.href = "index.html";
            } else {
                alert("Invalid credentials!");
            }
        });
    }
});
// Simulate fetching data for the dashboard
document.addEventListener("DOMContentLoaded", function () {
    // Simulated data fetching
    const totalProperties = 25;  // Example data
    const totalUsers = 150;      // Example data
    const activeListings = 10;   // Example data

    // Updating the dashboard with the fetched data
    document.getElementById("total-properties").textContent = totalProperties;
    document.getElementById("total-users").textContent = totalUsers;
    document.getElementById("active-listings").textContent = activeListings;

    // Example activity data (normally fetched from a server)
    const activityTable = document.getElementById("activity-table").getElementsByTagName('tbody')[0];
    const activityData = [
        { user: "Alice", action: "Updated property details", date: "2024-11-23" },
        { user: "Bob", action: "Added a new property", date: "2024-11-22" },
    ];

    // Populate activity table
    activityData.forEach(activity => {
        const row = activityTable.insertRow();
        row.innerHTML = `<td>${activity.user}</td><td>${activity.action}</td><td>${activity.date}</td>`;
    });
});

// Logout functionality
document.getElementById("logout")?.addEventListener("click", function (e) {
    e.preventDefault();
    // Simulate logout by redirecting
    window.location.href = "login.html";
});
