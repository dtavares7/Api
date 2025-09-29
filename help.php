<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Arduino Code Generator API - Help</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: auto;
            padding: 20px;
            line-height: 1.6;
            background: #f9f9f9;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        code {
            background: #eee;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 0.95em;
        }

        .endpoint {
            border: 1px solid #ddd;
            background: #fff;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        ul {
            margin: 5px 0 15px 20px;
        }
    </style>
</head>

<body>
    <h1>Arduino Code Generator API – Help</h1>
    <p>
        This API dynamically generates Arduino <code>C/C++</code> code for different
        communication protocols (<b>I2C</b>, <b>UART</b>, <b>TCP/MQTT</b>) based on URL parameters.
    </p>

    <h2>Base Endpoint</h2>
    <p><code>http://localhost/api/index.php</code></p>

    <h2>Required Global Parameters</h2>
    <ul>
        <li><code>protocol</code> – one of: <b>i2c</b>, <b>uart</b>, <b>tcp</b></li>
        <li><code>projectName</code> – C identifier-friendly string (letters, digits, underscore; must not start with digit)</li>
        <li><code>eventName</code> – same restrictions as <code>projectName</code></li>
    </ul>

    <h2>Protocols</h2>

    <div class="endpoint">
        <h3>1. I2C</h3>
        <p><code>?protocol=i2c&amp;projectName=Demo&amp;eventName=btnPress&amp;slaveAddress=8&amp;slaveMessage=A</code></p>
        <ul>
            <li><b>slaveAddress</b> (int, required) – range 8–119</li>
            <li><b>slaveMessage</b> (required) – single ASCII char or ASCII code (int 0–127)</li>
        </ul>
        <p><b>Limitations:</b></p>
        <ul>
            <li>Repeated usage of same protocol & event may duplicate code sections.</li>
            <li>Blocking I2C calls – ensure proper wiring & addressing.</li>
        </ul>
    </div>

    <div class="endpoint">
        <h3>2. UART</h3>
        <p><code>?protocol=uart&amp;projectName=Demo&amp;eventName=ledToggle&amp;baudRate=9600&amp;
            uartMessage=trigger_led&amp;rxPin_receiver=16&amp;txPin_receiver=17&amp;rxPin_sender=17&amp;txPin_sender=16</code></p>
        <ul>
            <li><b>serialPort</b> (int, optional, default=2) – ESP32: 0, 1, or 2</li>
            <li><b>baudRate</b> (int, optional, default=115200)</li>
            <li><b>rxPin_receiver</b> (int, optional, default=16) – The RX pin for the device receiving the message.</li>
            <li><b>txPin_receiver</b> (int, optional, default=17) – The TX pin for the device receiving the message.</li>
            <li><b>rxPin_sender</b> (int, optional, default=17) – The RX pin for the device sending the message.</li>
            <li><b>txPin_sender</b> (int, optional, default=16) – The TX pin for the device sending the message.</li>
            <li><b>uartMessage</b> (string, optional, default=<code>trigger_eventName</code>)</li>
        </ul>
        <p><b>Limitations:</b></p>
        <ul>
            <li>Event reset logic is required to avoid repeated triggers on the receiver side.</li>
        </ul>
    </div>

    <div class="endpoint">
        <h3>3. TCP / MQTT</h3>
        <p><code>?protocol=tcp&amp;projectName=Demo&amp;eventName=sensorAlert&amp;topic=device/events&amp;ssid=MyWiFi&amp;password=Secret</code></p>
        <ul>
            <li><b>topic</b> (string, required) – MQTT topic name</li>
            <li><b>clientID</b> (string, optional, default=<code>ESP32_IOPT</code>)</li>
            <li><b>broker</b> (string, optional, default=<code>broker.hivemq.com</code>)</li>
            <li><b>port</b> (int, optional, default=1883)</li>
            <li><b>ssid</b> / <b>password</b> (string, optional, default placeholders)</li>
            <li><b>tcpMessage</b> (string, optional, default=<code>trigger_eventName</code>)</li>
        </ul>
        <p><b>Limitations:</b></p>
        <ul>
            <li>MQTT code uses blocking WiFi connection logic – may stall until connected.</li>
            <li>Public brokers are for testing only; use a secured broker in production.</li>
            <li>Duplicated code may occur if multiple events share the same topic.</li>
        </ul>
    </div>

    <h2>Errors</h2>
    <p>
        On invalid input, the API responds with <code>HTTP 400</code> and a descriptive error message.
    </p>

    <h2>Best Practices</h2>
    <ul>
        <li>Always sanitize <code>projectName</code> and <code>eventName</code> for C compatibility.</li>
        <li>Do not reuse the same <code>eventName</code> across multiple protocols in one project without edits.</li>
        <li>Generated code may need minor manual integration (e.g., avoiding duplicate includes).</li>
    </ul>
</body>

</html>