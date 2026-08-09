<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>10 LED IoT Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef2f7, #dfe6ee);
            color: #222;
            text-align: center;
        }

        /* ================= HEADER ================= */

        .header {
            padding: 35px 20px 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .subtitle {
            margin-top: 10px;
            color: #666;
            font-size: 16px;
        }

        .connection {
            display: inline-block;
            margin-top: 15px;
            padding: 7px 18px;
            border-radius: 20px;
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 14px;
            font-weight: bold;
        }

        /* ================= LED GRID ================= */

        .container {
            display: grid;
            grid-template-columns: repeat(5, 170px);
            gap: 22px;

            justify-content: center;

            margin: 35px auto 30px;

            max-width: 1000px;
        }

        /* ================= LED CARD ================= */

        .led-box {
            background: white;

            padding: 22px 15px;

            border-radius: 16px;

            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);

            transition: 0.25s ease;
        }

        .led-box:hover {
            transform: translateY(-5px);

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18);
        }

        .led-box h3 {
            margin: 2px 0 15px;

            font-size: 20px;
        }

        /* ================= LED ================= */

        .led {
            width: 50px;
            height: 50px;

            border-radius: 50%;

            background: #777;

            border: 3px solid #ddd;

            margin: 12px auto 15px;

            transition: 0.3s ease;
        }

        /* LED ON */

        .led.on {
            background: #fff700;

            border-color: #ffe600;

            box-shadow:
                0 0 10px #fff700,
                0 0 25px #fff700,
                0 0 45px rgba(255, 247, 0, 0.8);
        }

        /* ================= STATUS ================= */

        .status {
            font-size: 13px;

            font-weight: bold;

            margin-bottom: 12px;

            color: #777;
        }

        .status.on {
            color: #2e7d32;
        }

        /* ================= ON/OFF BUTTON ================= */

        .control-btn {
            padding: 10px 18px;

            border: none;

            border-radius: 8px;

            background: #222;

            color: white;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s ease;
        }

        .control-btn:hover {
            background: #444;

            transform: scale(1.04);
        }

        /* ================= HISTORY ================= */

        .history-section {
            margin: 30px 0 45px;
        }

        .history-btn {
            display: inline-block;

            padding: 14px 30px;

            background: #111;

            color: white;

            text-decoration: none;

            border-radius: 10px;

            font-size: 16px;

            font-weight: bold;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.18);

            transition: 0.25s ease;
        }

        .history-btn:hover {
            background: #333;

            transform: translateY(-3px);

            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* ================= FOOTER ================= */

        footer {
            padding: 20px;

            color: #777;

            font-size: 13px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 950px) {

            .container {
                grid-template-columns: repeat(3, 170px);
            }

        }

        @media (max-width: 650px) {

            .container {
                grid-template-columns: repeat(2, 170px);
            }

            .header h1 {
                font-size: 29px;
            }

        }

        @media (max-width: 420px) {

            .container {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


    <!-- ================= HEADER ================= -->

    <div class="header">

        <h1>💡 10 LED IoT Dashboard</h1>

        <div class="subtitle">
            ESP32 Based Smart LED Control System
        </div>

        <div class="connection">
            ● System Connected
        </div>

    </div>


    <!-- ================= LED CONTAINER ================= -->

    <div class="container">


        <!-- LED 1 -->

        <div class="led-box">

            <h3>LED 1</h3>

            <div id="led1" class="led"></div>

            <div id="status1" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(1)">
                ON / OFF
            </button>

        </div>


        <!-- LED 2 -->

        <div class="led-box">

            <h3>LED 2</h3>

            <div id="led2" class="led"></div>

            <div id="status2" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(2)">
                ON / OFF
            </button>

        </div>


        <!-- LED 3 -->

        <div class="led-box">

            <h3>LED 3</h3>

            <div id="led3" class="led"></div>

            <div id="status3" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(3)">
                ON / OFF
            </button>

        </div>


        <!-- LED 4 -->

        <div class="led-box">

            <h3>LED 4</h3>

            <div id="led4" class="led"></div>

            <div id="status4" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(4)">
                ON / OFF
            </button>

        </div>


        <!-- LED 5 -->

        <div class="led-box">

            <h3>LED 5</h3>

            <div id="led5" class="led"></div>

            <div id="status5" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(5)">
                ON / OFF
            </button>

        </div>


        <!-- LED 6 -->

        <div class="led-box">

            <h3>LED 6</h3>

            <div id="led6" class="led"></div>

            <div id="status6" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(6)">
                ON / OFF
            </button>

        </div>


        <!-- LED 7 -->

        <div class="led-box">

            <h3>LED 7</h3>

            <div id="led7" class="led"></div>

            <div id="status7" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(7)">
                ON / OFF
            </button>

        </div>


        <!-- LED 8 -->

        <div class="led-box">

            <h3>LED 8</h3>

            <div id="led8" class="led"></div>

            <div id="status8" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(8)">
                ON / OFF
            </button>

        </div>


        <!-- LED 9 -->

        <div class="led-box">

            <h3>LED 9</h3>

            <div id="led9" class="led"></div>

            <div id="status9" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(9)">
                ON / OFF
            </button>

        </div>


        <!-- LED 10 -->

        <div class="led-box">

            <h3>LED 10</h3>

            <div id="led10" class="led"></div>

            <div id="status10" class="status">
                OFF
            </div>

            <button
                class="control-btn"
                onclick="toggleLED(10)">
                ON / OFF
            </button>

        </div>


    </div>


    <!-- ================= HISTORY BUTTON ================= -->

    <div class="history-section">

        <a
            href="history.php"
            class="history-btn">

            📊 Go to LED History

        </a>

    </div>


    <!-- ================= FOOTER ================= -->

    <footer>

        ESP32 • PHP • MySQL • IoT

    </footer>


    <!-- ================= JAVASCRIPT ================= -->

    <script>

        // Store current LED states
        let ledStates = [
            0, 0, 0, 0, 0,
            0, 0, 0, 0, 0
        ];


        // ==========================================
        // UPDATE LED DISPLAY
        // ==========================================

        function updateLEDVisual(led, state) {

            const ledElement =
                document.getElementById("led" + led);

            const statusElement =
                document.getElementById("status" + led);


            if (state == 1) {

                ledElement.classList.add("on");

                statusElement.innerText = "ON";

                statusElement.classList.add("on");

            } else {

                ledElement.classList.remove("on");

                statusElement.innerText = "OFF";

                statusElement.classList.remove("on");

            }


            ledStates[led - 1] = state;
        }


        // ==========================================
        // FETCH DATABASE STATUS
        // ==========================================

        function fetchLEDStatus() {

            fetch("fetch.php")

                .then(response => {

                    if (!response.ok) {

                        throw new Error(
                            "HTTP Error: " + response.status
                        );

                    }

                    return response.json();

                })

                .then(data => {

                    console.log(
                        "Database Data:",
                        data
                    );


                    for (let i = 1; i <= 10; i++) {

                        let value =
                            parseInt(
                                data["led" + i]
                            );


                        if (isNaN(value)) {

                            value = 0;

                        }


                        updateLEDVisual(
                            i,
                            value
                        );

                    }

                })

                .catch(error => {

                    console.error(
                        "Fetch error:",
                        error
                    );

                });

        }


        // ==========================================
        // TOGGLE LED
        // ==========================================

        function toggleLED(led) {

            let currentState =
                ledStates[led - 1];


            let newState =
                currentState === 1 ? 0 : 1;


            fetch("update.php", {

                method: "POST",

                headers: {

                    "Content-Type":
                        "application/x-www-form-urlencoded"

                },

                body:
                    "led=" +
                    led +
                    "&status=" +
                    newState

            })

            .then(response => {

                return response.text();

            })

            .then(result => {

                console.log(
                    "Update:",
                    result
                );


                /*
                 * Update dashboard immediately.
                 * update.php also updates the database.
                 */

                updateLEDVisual(
                    led,
                    newState
                );

            })

            .catch(error => {

                console.error(
                    "Update error:",
                    error
                );

            });

        }


        // ==========================================
        // FIRST LOAD
        // ==========================================

        fetchLEDStatus();


        // ==========================================
        // AUTO REFRESH
        // ==========================================

        setInterval(
            fetchLEDStatus,
            1000
        );

    </script>


</body>

</html>