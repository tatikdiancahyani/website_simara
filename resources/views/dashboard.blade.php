@extends('layouts.app') 
@section('contents')
<!DOCTYPE html>
<html lang="en">
<html>
    <head>
      <title>
        Calendar
      </title>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
      <style>
        body {
                  margin: 0;
                  font-family: Arial, sans-serif;
                  background-color: #000;
              }
              .header {
                  background-color: #0000FF;
                  color: white;
                  padding: 10px;
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
              }
              .header .logo {
                  display: flex;
                  align-items: center;
              }
              .header .logo img {
                  height: 30px;
                  margin-right: 10px;
              }
              .header .user-info {
                  display: flex;
                  align-items: center;
              }
              .header .user-info i {
                  margin-left: 10px;
              }
              .main-content {
                  margin-left: 60px;
                  padding: 20px;
                  background-color: #fff;
                  color: #000;
              }
              .calendar-header {
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                  margin-bottom: 10px;
              }
              .calendar-header h2 {
                  margin: 0;
              }
              .calendar-header .controls {
                  display: flex;
                  align-items: center;
              }
              .calendar-header .controls button {
                  margin-left: 5px;
                  padding: 5px 10px;
                  background-color: #ccc;
                  border: none;
                  cursor: pointer;
              }
              .calendar {
                  display: grid;
                  grid-template-columns: repeat(7, 1fr);
                  gap: 1px;
                  background-color: #ccc;
              }
              .calendar .day {
                  background-color: #fff;
                  padding: 10px;
                  min-height: 100px;
                  position: relative;
              }
              .calendar .day .event {
                  background-color: #007bff;
                  color: white;
                  padding: 2px 5px;
                  border-radius: 3px;
                  font-size: 12px;
                  position: absolute;
                  bottom: 5px;
                  left: 5px;
              }
              .calendar .day .event.pink {
                  background-color: #ff007b;
              }
              .reminder {
                  margin-top: 20px;
              }
              .reminder h3 {
                  margin-top: 0;
              }
              .reminder ul {
                  list-style: none;
                  padding: 0;
              }
              .reminder ul li {
                  display: flex;
                  align-items: center;
                  margin-bottom: 5px;
              }
              .reminder ul li .color-box {
                  width: 10px;
                  height: 10px;
                  margin-right: 5px;
              }
              .reminder ul li .color-box.red { background-color: red; }
              .reminder ul li .color-box.green { background-color: green; }
              .reminder ul li .color-box.blue { background-color: blue; }
              .reminder ul li .color-box.yellow { background-color: yellow; }
              .reminder ul li .color-box.purple { background-color: purple; }
              .reminder ul li .color-box.orange { background-color: orange; }
      </style>
    </head>
    <body>
      @if(session('success'))
      <p>{{ session('success') }}</p>
      @endif
              
      <h2>Tambah Jadwal Rapat</h2>
      <form action="{{ route('jadwal-rapat.store') }}" method="POST">
          @csrf
          <label for="judul">Judul Rapat:</label>
          <input type="text" id="judul" name="judul" required>

          <label for="tanggal">Tanggal:</label>
          <input type="date" id="tanggal" name="tanggal" required>

          <label for="waktu">Waktu:</label>
          <input type="time" id="waktu" name="waktu" required>

          <label for="tempat">Tempat:</label>
          <input type="text" id="tempat" name="tempat" required>

          <button type="submit">Simpan Jadwal</button>
      </form>

      <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }
        .day {
            padding: 10px;
            text-align: center;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }
        .controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .calendar-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
        }

        .controls button {
            background-color: #45a049;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        .controls button:hover {
            background-color: #388e3c;
        }

        .controls h2 {
            margin: 0;
            font-size: 18px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            padding: 20px;
        }

        .day {
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            padding: 15px 0;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            font-weight: bold;
        }

        .day:hover {
            background-color: #4CAF50;
            color: white;
        }

        .day.today {
            background-color: #FF9800;
            color: white;
            font-weight: bold;
        }

        .day.empty {
            background-color: transparent;
            cursor: default;
        }

        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            padding: 10px;
            background-color: #e0e0e0;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .calendar-container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2196F3;
            color: white;
            padding: 15px 20px;
        }

        .controls button {
            background-color: #1E88E5;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        .controls button:hover {
            background-color: #1565C0;
        }

        .controls h2 {
            margin: 0;
            font-size: 20px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            padding: 20px;
        }

        .day {
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            padding: 20px 0;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            font-weight: bold;
            font-size: 16px;
        }

        .day:hover {
            background-color: #2196F3;
            color: white;
        }

        .day.today {
            background-color: #FFC107;
            color: white;
            font-weight: bold;
        }

        .day.empty {
            background-color: transparent;
            cursor: default;
        }

        .weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            padding: 10px;
            background-color: #E3F2FD;
            color: #1565C0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="calendar-container">
        <div class="controls">
            <button id="prevMonth">Previous</button>
            <h2 id="currentMonth"></h2>
            <button id="nextMonth">Next</button>
        </div>
        <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div id="calendar" class="calendar"></div>
    </div>
    <script>
    const calendar = document.getElementById('calendar');
    const currentMonthElement = document.getElementById('currentMonth');
    let currentDate = new Date();
    let jadwalRapat = [];

    // Fetch jadwal rapat dari server
    async function fetchJadwalRapat() {
        try {
            const response = await fetch('/jadwal-rapat'); // Endpoint untuk mendapatkan data rapat
            jadwalRapat = await response.json();
        } catch (error) {
            console.error('Error fetching jadwal rapat:', error);
        }
    }

    function renderCalendar(date) {
        // Clear existing calendar
        calendar.innerHTML = '';

        // Get the first day and last day of the month
        const year = date.getFullYear();
        const month = date.getMonth();
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        // Update current month display
        currentMonthElement.textContent = date.toLocaleDateString('en-US', {
            month: 'long',
            year: 'numeric',
        });

        // Add empty days for the first week
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('day', 'empty');
            calendar.appendChild(emptyCell);
        }

        // Add days of the month
        for (let day = 1; day <= lastDate; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('day');

            // Highlight today
            if (
                day === new Date().getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear()
            ) {
                dayCell.classList.add('today');
            }

            // Check for events on this day
            const events = jadwalRapat.filter((item) => {
                const eventDate = new Date(item.tanggal);
                return (
                    eventDate.getDate() === day &&
                    eventDate.getMonth() === month &&
                    eventDate.getFullYear() === year
                );
            });

            if (events.length > 0) {
                dayCell.classList.add('event');
                dayCell.style.backgroundColor = '#4CAF50'; // Highlight with green
                dayCell.style.color = '#fff';
                // Add day number and event titles
                dayCell.innerHTML = `<strong>${day}</strong><br>`;
                events.forEach((event) => {
                    const title = document.createElement('span');
                    title.textContent = event.judul;
                    title.style.display = 'block';
                    title.style.fontSize = '12px';
                    title.style.marginTop = '5px';
                    dayCell.appendChild(title);
                });
            } else {
                dayCell.textContent = day;
            }

            calendar.appendChild(dayCell);
        }
    }

    // Event listeners for navigation buttons
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    // Initialize the calendar
    fetchJadwalRapat().then(() => renderCalendar(currentDate));
</script>

</body>
</html>
</html>
</html>


@endsection