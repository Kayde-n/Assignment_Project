<?php
    require_once __DIR__ . "/../../session.php";
    require_once __DIR__ . "/../../config/Database.php";
    require_once __DIR__ . "/../../check-maintenance-status.php";

    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'event_manager') {
    echo "<script>
        alert('Access denied. Event Manager only.');
        window.location.href = '../../login.php';
    </script>";
    exit();
    }

    // get start time, event name 
    $calender_events="SELECT events.events_id, events.event_name, events.start_time
    FROM events";

    $result = mysqli_query($database, $calender_events);

    // create array for date and time
    $eventsArray = [];
        while ($row = mysqli_fetch_assoc($result)) {
            //this is to get date and time separately form the database
            $date = date('Y-m-d', strtotime($row['start_time']));
            $time = date('g:i A', strtotime($row['start_time']));

            if (!isset($eventsArray[$date])) {
                $eventsArray[$date] = [];
            }

            $eventsArray[$date][] = [
                'title' => $row['event_name'],
                'time' => $time,
                'eventId' => $row['events_id']
            ];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Calendar</title>
    <link rel="stylesheet" href="../../mobile.css">

    <link rel="stylesheet" href="../css/event-manager-calendar.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
        <!-- top bar -->
    <header class="top-bar" role="banner">
    <div class="top-left">
        <button class="icon-btn no-hover topbar-icon" onclick="window.location.href='event-manager-home.php'" style="display:flex;align-items:center;gap:8px;">
            <svg width="56" height="56" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <path d="M17.0278 55.17C17.9238 56.03 18.8788 56.833 19.8928 57.579C23.3048 55.1141 26.0849 51.8767 28.0058 48.1313C29.9267 44.386 30.9338 40.2392 30.9448 36.03C30.9448 27.216 26.5978 19.398 19.8748 14.478C18.8713 15.2154 17.9201 16.0213 17.0278 16.89C20.2462 18.9439 22.8981 21.7722 24.7408 25.1159C26.5835 28.4597 27.5583 32.2122 27.5758 36.03C27.5758 44.016 23.3968 51.042 17.0278 55.17Z" fill="var(--primary-green)"/>
                <path d="M57.0119 19.125C55.1822 23.1625 52.2267 26.5866 48.4997 28.9864C44.7728 31.3863 40.4326 32.6601 35.9999 32.655C31.5676 32.6595 27.2281 31.3854 23.5018 28.9856C19.7754 26.5858 16.8203 23.1621 14.9909 19.125C14.1119 20.205 13.3199 21.366 12.6299 22.578C15.0031 26.6727 18.4119 30.0707 22.5141 32.4309C26.6162 34.7911 31.2672 36.0303 35.9999 36.024C40.7325 36.0303 45.3835 34.7911 49.4857 32.4309C53.5878 30.0707 56.9967 26.6727 59.3699 22.578C58.6743 21.3678 57.886 20.2133 57.0119 19.125ZM30.9449 62.427C31.2809 47.787 43.0769 36.027 57.5669 36.027C59.3783 36.0212 61.1852 36.2063 62.9579 36.579C62.929 37.7587 62.8227 38.9352 62.6399 40.101C60.8168 39.6325 58.9422 39.3947 57.0599 39.393C54.0149 39.4167 51.005 40.0462 48.2057 41.2447C45.4064 42.4432 42.8736 44.1869 40.7549 46.374C38.6374 48.5623 36.9773 51.1506 35.8714 53.9878C34.7655 56.8249 34.236 59.854 34.3139 62.898C33.1812 62.8209 32.0553 62.6635 30.9449 62.427Z" fill="var(--primary-green)"/>
                <path d="M59.5382 37.509C58.7462 49.572 48.2161 59.616 36.0001 59.616C35.0881 59.618 34.1841 59.561 33.2881 59.445L32.8681 62.817C36.416 63.2333 40.0111 62.9403 43.4447 61.955C46.8783 60.9697 50.0817 59.3118 52.8689 57.0776C55.6561 54.8433 57.9715 52.0774 59.6803 48.9405C61.3892 45.8036 62.4575 42.3584 62.8232 38.805L59.5892 37.695L59.5382 37.491V37.509ZM58.8152 21.639C55.7076 16.6761 51.0676 12.8608 45.5977 10.7707C40.1278 8.6807 34.1259 8.42974 28.5007 10.0558C22.8754 11.682 17.9332 15.0966 14.4221 19.7827C10.911 24.4689 9.02242 30.1715 9.04215 36.027C9.04215 44.382 12.8521 51.867 18.8131 56.802L21.5791 54.492C18.7623 52.3004 16.4753 49.5023 14.8882 46.3056C13.301 43.1089 12.4544 39.5958 12.4111 36.027C12.4111 23.322 23.2951 12.438 36.0001 12.438C40.1006 12.4994 44.1165 13.6131 47.6629 15.6723C51.2092 17.7316 54.1672 20.6673 56.2531 24.198L58.8152 21.639Z" fill="var(--primary-green)"/>
            </svg>
            <h2 class="top-title">EcoXP</h2>
        </button>
    </div>

    <div class="top-center">
    </div>

    <div class="top-right">
        <a href="event-manager-profile.php" aria-label="Profile" class="topbar-icon">
            <button class="icon-btn" aria-label="Profile">
                <i data-lucide="user-round"></i>
            </button>
        </a>
    </div>
    </header>

<!-- side bar -->
    <nav class="side-bar" role="navigation" aria-label="Main">
    <div class="participant-icon-container">
        <div id="home-icon-box">
        <a href="event-manager-home.php" class="icon-link sidebar-icon" aria-label="Home">
            <button class="icon-btn"><i data-lucide="house"></i></button>
        </a>
        </div>

        <a class="icon-link active sidebar-icon" href="event-manager-calendar.php" aria-label="Callendar">
        <button class="icon-btn"><i data-lucide="calendar-fold"></i></button>
        </a>

        <a class="icon-link sidebar-icon" href="event-manager-news.php" aria-label="News Feed Management">
        <button class="icon-btn"><i data-lucide="newspaper"></i></button>
        </a>

        <a class="icon-link sidebar-icon" href="event-manager-rewards-management.php" aria-label="Rewards">
        <button class="icon-btn"><i data-lucide="badge-percent"></i></button>
        </a>

    </div>

    <a class="icon-link sidebar-icon"  id="logout" aria-label="Logout" onclick="return logout_confirm();">
        <button class="icon-btn"><i data-lucide="log-out"></i></button>
    </a>
    </nav>

    <!-- nav bar -->
    <nav class="bottom-nav">
        <a href="event-manager-home.php" class="nav-item">
            <i data-lucide="house" class="icon-btn"></i>
        </a>
        <a href="event-manager-calendar.php" class="nav-item active">
            <i data-lucide="calendar-fold" class="icon-btn"></i>
        </a>
        <a href="event-manager-news.php" class="nav-item">
            <i data-lucide="newspaper" class="icon-btn"></i>
        </a>
        <a href="event-manager-rewards-management.php" class="nav-item">
            <i data-lucide="badge-percent" class="icon-btn"></i>
        </a>
        <a href="event-manager-profile.php" class="nav-item">
            <i data-lucide="user-round" class="icon-btn"></i>
        </a>
        
    </nav>

    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Events Calendar</h1>
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
                </div>
            </div>

            <!-- Events Section -->
            <div class="events-section">
                <div class="events-header">
                    <h3>Events</h3>
                    <button class="add-event-btn" onclick="window.location.href='event-manager-event-form.php'">
                        <img src="../../images/add.png" alt="More options" width="20" height="20" class="white-icon">
                        </svg>
                    </button>
                </div>

                <div class="events-list">
            </div>
        </div>
    </div>
    <script>
        // Current date tracking
        let currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth();

        //databse punya itu results
        const eventsData = <?php echo json_encode($eventsArray); ?>;
        

        //all them months
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

        // get number of days in each month
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
                            time: event.time,
                            eventId: event.eventId  
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
                    <img src="../../images/event-icon.png" alt="Event" onerror="this.style.display='none'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendars-icon lucide-calendars"><path d="M12 2v2"/><path d="M15.726 21.01A2 2 0 0 1 14 22H4a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2"/><path d="M18 2v2"/><path d="M2 13h2"/><path d="M8 8h14"/><rect x="8" y="3" width="14" height="14" rx="2"/></svg>
                </div>
                <div class="event-details">
                    <h4>${event.title}</h4>
                    <p class="event-date">${formattedDate} • ${event.time}</p>
                </div>
                <button class="event-menu-btn" data-event-id="${event.eventId}" onclick="showEventMenu(this, '${event.title}')">
                    <img src="../../images/Trash.png" alt="Deletion" width="20" height="20">
                </button>
            `;
            eventItem.addEventListener('click', function(e) {
                if (!e.target.closest('.event-menu-btn')) {
                    window.location.href = `event-manager-event-details.php?events_id=${event.eventId}`;
                }
            });


            
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
                        time: event.time,
                        eventId: event.eventId  
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

        // Show event menu (for deletion)
        function showEventMenu(button, title) {
            const eventId = button.dataset.eventId;
            if (confirm(`Options for "${title}":\n\nClick OK to delete this event`)) {
                 window.location.href = `delete_event.php?event_id=${eventId}`;
            }
        }


        // Initialize calendar on page load
        document.addEventListener('DOMContentLoaded', function() {
            generateCalendar();
        });

        function logout_confirm() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "../../logout.php";
                }
            }

        lucide.createIcons();
    </script>
</body>
</html>