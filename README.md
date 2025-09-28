# IOPT Communication Module Generator API

This project is a web-based API designed to address the "communication gap" in the IOPT-Tools framework. It automatically generates C++ code for communication modules used in distributed controllers that are specified with IOPT Petri nets.

The tool takes a set of URL parameters specifying a protocol and its configuration, and returns ready-to-use C++ code for the Arduino/ESP32 platform.

## Features

* Generates C++ code for Arduino/ESP32 platforms.
* Supports three common communication protocols: **I²C**, **UART**, and **TCP/MQTT**.
* Simple GET-based API for ease of use, testing, and integration.
* Provides commented, structured code ready to be inserted into the IOPT-Tools-generated `net_io.cpp` file.

## Requirements

* A local web server environment. **[XAMPP](https://www.apachefriends.org/index.html)** is recommended as it includes Apache and PHP.
* **PHP 7.4** or higher.

## Installation and Setup

Follow these steps to run the API on your local machine.

1.  **Download and Install XAMPP:**
    If you don't have a local server, download and install XAMPP from the official website.

2.  **Place Project Files:**
    Clone or download this repository into the **`htdocs`** directory of your XAMPP installation. The path is typically `C:/xampp/htdocs/`. You can place the project files in a subfolder, for example: `C:/xampp/htdocs/iopt-api/`.

3.  **Start Apache Server:**
    Open the XAMPP Control Panel and start the **Apache** module. A green status indicates it's running correctly.

    [Image of XAMPP Control Panel with Apache started]

## Usage

The API is now running and accessible from your web browser.

### API Endpoints and Parameters
For a complete and detailed list of all global, required, and optional parameters for each protocol, please open the interactive help file in your browser.

Assuming you placed the project in an `iopt-api` folder, the link is:
**`http://localhost/iopt-api/help.php`**

This help page provides the definitive guide on how to construct the API calls.

### Example API Calls

Here are a few examples you can try directly in your browser's address bar:

* **Generate code for an I²C event:**
    ```
    http://localhost/iopt-api/gals.php?protocol=i2c&projectName=Demo&eventName=btnPress&slave
