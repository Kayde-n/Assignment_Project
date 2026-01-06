<?php
    include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Calendar</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="event-manager.css">
    <link rel="stylesheet" href="event-manager-calendar.css">
</head>
<body>
    <div class="top-bar">
        <img src="images/ecoxp-logo.png" alt="EcoXP Logo" class="eco-logo">
        <button class="icon-btn no-hover" onclick="window.location.href='participants-desktop-home.php'">
            <h2>EcoXP</h2>
        </button>
        <div class="default-icon-container">
            <button class="icon-btn"><img
                    src="images/profile.png" alt="Profile Logo"></button>
            <button class="icon-btn"><img src="images/notif.png" alt="Notification Logo"></button>
            <button class="icon-btn"><img src="images/setting.png" alt="Setting Logo"></button>
        </div>
    </div>

    <div class="side-bar">
        <div class="event-manager-icon-container">
            <button class="icon-btn" onclick="window.location.href='event-manager-home.php'"><img src="images/home.png" alt="Home"></button>
            <div id="calendar-icon-box">
                <button class="icon-btn" onclick="window.location.href='event-manager-calendar.php'"><img src="images/calendar.png" alt="Calendar"></button>
            </div>
            <button class="icon-btn" onclick="window.location.href='event-manager-news.php'"><img src="images/newspaper.png" alt="News"></button>
            <button class="icon-btn" onclick="window.location.href='event-manager-rewards-management.php'"><img src="images/tag.png" alt="Rewards"></button>
            <button class="icon-btn" id="logout"><img src="images/logout.png" alt="Logout"></button>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="title-box"><h1>Events Calendar</h1></div>
        </div>

        <!-- Calendar and Events Container -->
        <div class="calendar-container">
            <!-- Calendar Section -->
            <div class="calendar-section">
                <!-- Calendar Header -->
                <div class="calendar-header">
                    <button class="nav-btn" onclick="previousMonth()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <h3 class="calendar-title" id="monthYear">November 2025</h3>
                    <button class="nav-btn" onclick="nextMonth()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>

                <!-- Calendar Grid -->
                <div class="calendar-grid">
                    <!-- Day Headers -->
                    <div class="day-header">Su</div>
                    <div class="day-header">Mo</div>
                    <div class="day-header">Tu</div>
                    <div class="day-header">We</div>
                    <div class="day-header">Th</div>
                    <div class="day-header">Fr</div>
                    <div class="day-header">Sa</div>

                    <!-- Days (Previous Month) -->
                    <div class="day-cell other-month">29</div>
                    <div class="day-cell other-month">30</div>

                    <!-- Days (Current Month) -->
                    <div class="day-cell has-event" data-date="2025-11-01">1</div>
                    <div class="day-cell">2</div>
                    <div class="day-cell has-event" data-date="2025-11-03">3</div>
                    <div class="day-cell">4</div>
                    <div class="day-cell">5</div>
                    <div class="day-cell">6</div>
                    <div class="day-cell">7</div>
                    <div class="day-cell">8</div>
                    <div class="day-cell">9</div>
                    <div class="day-cell">10</div>
                    <div class="day-cell has-event" data-date="2025-11-11">11</div>
                    <div class="day-cell">12</div>
                    <div class="day-cell has-event" data-date="2025-11-13">13</div>
                    <div class="day-cell has-event" data-date="2025-11-14">14</div>
                    <div class="day-cell">15</div>
                    <div class="day-cell">16</div>
                    <div class="day-cell">17</div>
                    <div class="day-cell">18</div>
                    <div class="day-cell">19</div>
                    <div class="day-cell">20</div>
                    <div class="day-cell">21</div>
                    <div class="day-cell">22</div>
                    <div class="day-cell has-event" data-date="2025-11-23">23</div>
                    <div class="day-cell">24</div>
                    <div class="day-cell">25</div>
                    <div class="day-cell">26</div>
                    <div class="day-cell">27</div>
                    <div class="day-cell other-month">28</div>
                    <div class="day-cell has-event other-month" data-date="2025-11-29">29</div>
                    <div class="day-cell has-event other-month" data-date="2025-11-30">30</div>
                    <div class="day-cell has-event other-month" data-date="2025-12-01">31</div>
                    <div class="day-cell other-month">1</div>
                    <div class="day-cell other-month">2</div>
                </div>
            </div>

            <!-- Events Section -->
            <div class="events-section">
                <div class="events-header">
                    <h3>Events</h3>
                    <button class="add-event-btn" onclick="window.location.href='event-manager-event-form.php'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                </div>

                <div class="events-list">
                    <div class="event-item">
                        <div class="event-icon">
                            <img src="images/event-icon.png" alt="Event">
                        </div>
                        <div class="event-details">
                            <h4>Urban Green Activity</h4>
                            <p class="event-date">Nov 1, 2025</p>
                        </div>
                        <button class="event-menu-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                    </div>

                    <div class="event-item">
                        <div class="event-icon">
                            <img src="images/event-icon.png" alt="Event">
                        </div>
                        <div class="event-details">
                            <h4>Beach Cleanup Drive</h4>
                            <p class="event-date">Nov 3, 2025</p>
                        </div>
                        <button class="event-menu-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                    </div>

                    <div class="event-item">
                        <div class="event-icon">
                            <img src="images/event-icon.png" alt="Event">
                        </div>
                        <div class="event-details">
                            <h4>Tree Planting Event</h4>
                            <p class="event-date">Nov 11, 2025</p>
                        </div>
                        <button class="event-menu-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Current date tracking
        let currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth();

        // Sample events data (you can fetch this from database)
        const eventsData = {
            '2025-11-01': [{ title: 'Urban Green Activity', time: '10:00 AM' }],
            '2025-11-03': [{ title: 'Beach Cleanup Drive', time: '2:00 PM' }],
            '2025-11-11': [{ title: 'Tree Planting Event', time: '9:00 AM' }],
            '2025-11-13': [{ title: 'Recycling Workshop', time: '3:00 PM' }],
            '2025-11-14': [{ title: 'Community Garden Day', time: '11:00 AM' }],
            '2025-11-23': [{ title: 'Sustainability Seminar', time: '1:00 PM' }],
            '2025-11-29': [{ title: 'Eco Fair', time: '10:00 AM' }],
            '2025-11-30': [{ title: 'Green Energy Talk', time: '4:00 PM' }],
            '2025-12-01': [{ title: 'Winter Cleanup', time: '8:00 AM' }]
        };

        // Month names
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Day names
        const dayNames = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

        // Format date as YYYY-MM-DD
        function formatDate(year, month, day) {
            const m = (month + 1).toString().padStart(2, '0');
            const d = day.toString().padStart(2, '0');
            return `${year}-${m}-${d}`;
        }

        // Get number of days in month
        function getDaysInMonth(year, month) {
            return new Date(year, month + 1, 0).getDate();
        }

        // Get first day of month (0 = Sunday, 6 = Saturday)
        function getFirstDayOfMonth(year, month) {
            return new Date(year, month, 1).getDay();
        }

        // Check if date is today
        function isToday(year, month, day) {
            const today = new Date();
            return year === today.getFullYear() && 
                month === today.getMonth() && 
                day === today.getDate();
        }

        // Check if date has events
        function hasEvents(dateString) {
            return eventsData.hasOwnProperty(dateString);
        }

        // Generate calendar
        function generateCalendar() {
            const calendarGrid = document.querySelector('.calendar-grid');
            const monthYearElement = document.getElementById('monthYear');
            
            // Update month/year display
            monthYearElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            
            // Clear existing calendar (keep day headers)
            const dayHeaders = Array.from(calendarGrid.children).slice(0, 7);
            calendarGrid.innerHTML = '';
            dayHeaders.forEach(header => calendarGrid.appendChild(header));
            
            // Get calendar data
            const daysInMonth = getDaysInMonth(currentYear, currentMonth);
            const firstDay = getFirstDayOfMonth(currentYear, currentMonth);
            const daysInPrevMonth = getDaysInMonth(currentYear, currentMonth - 1);
            
            // Add previous month's days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const cell = createDayCell(day, true, currentYear, currentMonth - 1);
                calendarGrid.appendChild(cell);
            }
            
            // Add current month's days
            for (let day = 1; day <= daysInMonth; day++) {
                const cell = createDayCell(day, false, currentYear, currentMonth);
                calendarGrid.appendChild(cell);
            }
            
            // Add next month's days to complete the grid
            const totalCells = calendarGrid.children.length - 7; // Subtract day headers
            const remainingCells = 42 - totalCells; // 6 rows × 7 days = 42
            
            for (let day = 1; day <= remainingCells; day++) {
                const cell = createDayCell(day, true, currentYear, currentMonth + 1);
                calendarGrid.appendChild(cell);
            }
            
            // Update events list
            updateEventsList();
        }

        // Create a day cell
        function createDayCell(day, isOtherMonth, year, month) {
            const cell = document.createElement('div');
            cell.className = 'day-cell';
            cell.textContent = day;
            
            // Adjust month for previous/next month
            let adjustedYear = year;
            let adjustedMonth = month;
            
            if (month < 0) {
                adjustedMonth = 11;
                adjustedYear = year - 1;
            } else if (month > 11) {
                adjustedMonth = 0;
                adjustedYear = year + 1;
            }
            
            const dateString = formatDate(adjustedYear, adjustedMonth, day);
            cell.dataset.date = dateString;
            
            // Add classes
            if (isOtherMonth) {
                cell.classList.add('other-month');
            }
            
            if (isToday(adjustedYear, adjustedMonth, day)) {
                cell.classList.add('today');
            }
            
            if (hasEvents(dateString)) {
                cell.classList.add('has-event');
            }
            
            // Add click handler
            cell.addEventListener('click', function() {
                // Remove active class from all cells
                document.querySelectorAll('.day-cell').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked cell
                this.classList.add('active');
                
                // Show events for this date
                showEventsForDate(dateString);
            });
            
            return cell;
        }

        // Update events list
        function updateEventsList() {
            const eventsList = document.querySelector('.events-list');
            eventsList.innerHTML = '';
            
            // Get all events for current month
            const monthEvents = [];
            
            for (let day = 1; day <= getDaysInMonth(currentYear, currentMonth); day++) {
                const dateString = formatDate(currentYear, currentMonth, day);
                if (hasEvents(dateString)) {
                    eventsData[dateString].forEach(event => {
                        monthEvents.push({
                            date: dateString,
                            day: day,
                            title: event.title,
                            time: event.time
                        });
                    });
                }
            }
            
            // Sort events by date
            monthEvents.sort((a, b) => new Date(a.date) - new Date(b.date));
            
            // Display events
            if (monthEvents.length === 0) {
                eventsList.innerHTML = '<p style="text-align: center; color: #BDBDBD; padding: 20px;">No events this month</p>';
            } else {
                monthEvents.forEach(event => {
                    const eventItem = createEventItem(event);
                    eventsList.appendChild(eventItem);
                });
            }
        }

        // Create event item
        function createEventItem(event) {
            const eventItem = document.createElement('div');
            eventItem.className = 'event-item';
            
            const formattedDate = formatEventDate(event.date);
            
            eventItem.innerHTML = `
                <div class="event-icon">
                    <img src="images/event-icon.png" alt="Event" onerror="this.style.display='none'">
                </div>
                <div class="event-details">
                    <h4>${event.title}</h4>
                    <p class="event-date">${formattedDate} • ${event.time}</p>
                </div>
                <button class="event-menu-btn" onclick="showEventMenu('${event.date}', '${event.title}')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="12" cy="5" r="1"></circle>
                        <circle cx="12" cy="19" r="1"></circle>
                    </svg>
                </button>
            `;
            
            return eventItem;
        }

        // Format event date for display
        function formatEventDate(dateString) {
            const date = new Date(dateString + 'T00:00:00');
            const monthShort = monthNames[date.getMonth()].substring(0, 3);
            return `${monthShort} ${date.getDate()}, ${date.getFullYear()}`;
        }

        // Show events for specific date
        function showEventsForDate(dateString) {
            const eventsList = document.querySelector('.events-list');
            eventsList.innerHTML = '';
            
            if (hasEvents(dateString)) {
                const events = eventsData[dateString];
                const date = new Date(dateString + 'T00:00:00');
                
                events.forEach(event => {
                    const eventItem = createEventItem({
                        date: dateString,
                        day: date.getDate(),
                        title: event.title,
                        time: event.time
                    });
                    eventsList.appendChild(eventItem);
                });
            } else {
                eventsList.innerHTML = '<p style="text-align: center; color: #BDBDBD; padding: 20px;">No events on this date</p>';
            }
        }

        // Navigate to previous month
        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar();
        }

        // Navigate to next month
        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar();
        }

        // Show event menu (edit/delete)
        function showEventMenu(date, title) {
            if (confirm(`Options for "${title}":\n\nClick OK to delete this event`)) {
                // Delete event
                if (eventsData[date]) {
                    eventsData[date] = eventsData[date].filter(e => e.title !== title);
                    if (eventsData[date].length === 0) {
                        delete eventsData[date];
                    }
                    generateCalendar();
                }
            }
        }


        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', function() {
            generateCalendar();
        });
    </script>
</body>
</html>