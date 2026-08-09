#include <WiFi.h>
#include <HTTPClient.h>

// ================= WIFI =================
const char* ssid = "vivo V60e";
const char* password = "MADHAN143";

// ================= XAMPP SERVER =================
// Your laptop IP + project folder
const char* SERVER_URL = "http://10.164.146.100/led_iot";

// ================= LED PINS =================
// LED wiring:
// GPIO -> Anode (+) -> LED -> 220Ω -> GND
const int ledPins[10] = {
  13, 12, 14, 27, 26,
  25, 33, 32, 18, 19
};

// ================= DASH BUTTON =================
#define DASH_BUTTON 23

// ================= LED STATES =================
bool ledState[10] = {
  false, false, false, false, false,
  false, false, false, false, false
};

// ================= BUTTON VARIABLES =================
bool lastButtonState = HIGH;
unsigned long lastDebounceTime = 0;
const unsigned long debounceDelay = 50;


// =================================================
// SETUP
// =================================================

void setup() {

  Serial.begin(115200);

  // ---------------- LED SETUP ----------------
  for (int i = 0; i < 10; i++) {

    pinMode(ledPins[i], OUTPUT);

    // Active HIGH
    digitalWrite(ledPins[i], LOW);
  }

  // ---------------- BUTTON SETUP ----------------
  pinMode(DASH_BUTTON, INPUT_PULLUP);

  // ---------------- WIFI ----------------
  WiFi.begin(ssid, password);

  Serial.print("Connecting to WiFi");

  while (WiFi.status() != WL_CONNECTED) {

    delay(500);
    Serial.print(".");
  }

  Serial.println();
  Serial.println("WiFi Connected!");

  Serial.print("ESP32 IP: ");
  Serial.println(WiFi.localIP());

  Serial.println("----------------------------");
  Serial.println("System Ready");
  Serial.println("----------------------------");
}


// =================================================
// LOOP
// =================================================

void loop() {

  // Check physical/dashboard button
  checkDashButton();

  // Get LED status from MySQL through PHP
  fetchLEDStatus();

  delay(1000);
}


// =================================================
// DASH BUTTON
// =================================================

void checkDashButton() {

  bool reading = digitalRead(DASH_BUTTON);

  // Detect button state change
  if (reading != lastButtonState) {

    lastDebounceTime = millis();
  }

  // Debounce
  if ((millis() - lastDebounceTime) > debounceDelay) {

    // Button pressed
    if (reading == LOW && lastButtonState == HIGH) {

      Serial.println();
      Serial.println("Dash Button Pressed!");

      // Toggle all LEDs
      bool newState = !ledState[0];

      for (int i = 0; i < 10; i++) {

        ledState[i] = newState;

        // Active HIGH
        digitalWrite(
          ledPins[i],
          newState ? HIGH : LOW
        );
      }

      // Update database
      updateAllLEDs(newState);
    }
  }

  lastButtonState = reading;
}


// =================================================
// GET LED STATUS FROM PHP / DATABASE
// =================================================

void fetchLEDStatus() {

  if (WiFi.status() != WL_CONNECTED) {

    Serial.println("WiFi disconnected!");
    return;
  }

  HTTPClient http;

  String url = String(SERVER_URL) + "/fetch.php";

  http.begin(url);

  int httpCode = http.GET();

  // ---------------- SUCCESS ----------------
  if (httpCode == HTTP_CODE_OK) {

    String response = http.getString();

    Serial.println();
    Serial.println("Database Data:");
    Serial.println(response);

    // -----------------------------------------
    // Read LED1 to LED10
    // Expected JSON:
    //
    // "led1":"1"
    // "led2":"0"
    // -----------------------------------------

    for (int i = 0; i < 10; i++) {

      String key = "\"led" + String(i + 1) + "\":\"";

      int position = response.indexOf(key);

      if (position != -1) {

        // Position after:
        // "led1":"
        int valueStart = position + key.length();

        // Read 0 or 1
        int value = response.charAt(valueStart) - '0';

        // Store state
        ledState[i] = (value == 1);

        // Control physical LED
        digitalWrite(
          ledPins[i],
          value == 1 ? HIGH : LOW
        );

        // Serial output
        Serial.print("LED ");
        Serial.print(i + 1);
        Serial.print(" = ");
        Serial.println(value);
      }
      else {

        Serial.print("LED ");
        Serial.print(i + 1);
        Serial.println(" value not found");
      }
    }
  }

  // ---------------- ERROR ----------------
  else {

    Serial.print("HTTP Error: ");
    Serial.println(httpCode);
  }

  http.end();
}


// =================================================
// UPDATE ALL LEDs IN DATABASE
// =================================================

void updateAllLEDs(bool state) {

  if (WiFi.status() != WL_CONNECTED) {

    Serial.println("WiFi disconnected!");
    return;
  }

  // Update LED1 to LED10
  for (int i = 0; i < 10; i++) {

    HTTPClient http;

    String url = String(SERVER_URL) + "/update.php";

    http.begin(url);

    http.addHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );

    // Example:
    // led=1&status=1
    String postData =
      "led=" + String(i + 1) +
      "&status=" + String(state ? 1 : 0);

    int httpCode = http.POST(postData);

    Serial.print("LED ");
    Serial.print(i + 1);
    Serial.print(" update: ");
    Serial.println(httpCode);

    http.end();

    delay(100);
  }
}