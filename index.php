<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBD • Visitor's Log</title>

    <!-- Bootstrap 5.2 -->
    <link href="stylesheets/css/bootstrap.min.css" rel="stylesheet">
    <script src="stylesheets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="stylesheets/css/bootstrap-icons-1.10.5/font/bootstrap-icons.css">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="stylesheets/css/jquery.datatables.min.css">
    <link href="stylesheets/css/buttons.datatables.min.css" rel="stylesheet" type="text/css">

    <!-- JQuery -->
    <script type="text/javascript" src="stylesheets/js/jquery-3.7.0.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="stylesheets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="stylesheets/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="icon" type="image/x-icon" href="assets/mbd_logo.ico">

    <!-- Data Tables Min -->
    <script type="text/javascript" charset="utf8" src="stylesheets/js/jquery.datatables.min.js"></script>

    <!-- SELECT2 -->
    <link rel="stylesheet" href="stylesheets/css/select2.min.css" />
    <script src="stylesheets/js/select2.min.js"></script>

    <!-- Select2 -->
    <link href="stylesheets/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <script src="stylesheets/select2-4.0.13/dist/js/select2.min.js"></script>

    <!-- Bootstrap Select Picker -->
    <link rel="stylesheet" href="stylesheets/css/bootstrap-select.min.css">
    <script src="stylesheets/js/bootstrap-select.min.js"></script>

    <!-- Alertify JS -->
    <link rel=" stylesheet" href="stylesheets/css/alertify.min.css" />
    <link rel="stylesheet" href="stylesheets/css/bootstrap.rtl.min.css" />

    <!-- For Digi-clock -->
    <script type="text/javascript" src="stylesheets/js/moment.min.js"></script>

    <!-- Scanner -->
    <script type="text/javascript" src="stylesheets/js/quagga.min.js"></script>

</head>
<body>

<div class="p-2">
    <div class="container-fluid">

        <div class="d-flex">
            <!-- Left -->
            <div class="w-25 mt-2 mb-3 bg-light shadow-sm rounded-3 p-2 text-center left-row">
                <img src="assets/top.png" class="w-100">
                <h2>Scan Visitor Pass</h4>
                <hr>
                <div class="w-100" id="scanqr">
                    <video id="cameraFeed" class="w-100 h-100"></video>
                    <span class="d-none" id="qrdata"></span>
                </div>
                <input type="password" id="barcode_data" class="form-control text-center fw-bold" autofocus>
            </div>

            <!-- Middle -->
            <div class="w-50 mt-2 mb-3 bg-light shadow-sm rounded-3 p-2 left-row text-center">
                <h3>Log first, then scan. Thank you, next!</h3>
                <hr>
                <table class="table table-borderless text-center">
                    <tbody>
                        <tr>
                            <td class="fw-bold text-start">Name</td>
                            <td><input type="text" id="visitors_name" class="form-control"></td>
                            <td class="fw-bold text-start">Date</td>
                            <td><input type="date" id="date_visited" class="form-control" disabled></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">Company</td>
                            <td>
                                <input type="text" id="newcompany" class="form-control d-none">
                                <select id="visitors_company" class="form-control selectpicker" data-live-search="true"></select>
                                <input type="checkbox" id="notfound" onchange="ifNotFound();"> <label for="notfound" class="notfound">Not Found</label>
                            </td>
                            <td class="fw-bold text-start">Contact No.</td>
                            <td><input type="text" id="visitors_contact" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start">Person to Visit</td>
                            <td>
                                <select id="select_person" class="form-select">
                                    <option selected hidden></option>
                                    <option value="MIS DEPARTMENT">MIS DEPARTMENT</option>
                                    <option value="FINANCE DEPARTMENT">FINANCE DEPARTMENT</option>
                                    <option value="HR DEPARTMENT">HR DEPARTMENT</option>
                                    <option value="PURCHASING DEPARTMENT">PURCHASING DEPARTMENT</option>
                                    <option value="AUDIT DEPARTMENT">AUDIT DEPARTMENT</option>
                                    <option value="BUSINESS DEVELOPMENT DEPARTMENT">BUSINESS DEVELOPMENT DEPARTMENT</option>
                                    <option value="CONSTRUCTION DEPARTMENT">CONSTRUCTION DEPARTMENT</option>
                                    <option value="ADMIN AND LEGAL DEPARTMENT">ADMIN AND LEGAL DEPARTMENT</option>
                                </select>
                            </td>
                            <td class="fw-bold text-start">Purpose</td>
                            <td>
                                <select id="select_purpose" class="form-select" onchange="forCounter();">
                                    <option selected hidden></option>
                                    <option value="COLLECTION">COLLECTION</option>
                                    <option value="LAST PAY">LAST PAY</option>
                                    <option value="COUNTER">COUNTER</option>
                                    <option value="OTHERS">OTHERS</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="for_counter d-none">
                            <td></td>
                            <td></td>
                            <td class="fw-bold text-start">DR / SI #</td>
                            <td>
                                <textarea id="visitors_drsi" class="form-control" rows="2"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm generate-btn w-25" onclick="createLog();">Log</button>
                </div>
            </div>

            <!-- Right -->
            <div class="w-25 mt-2 mb-3 bg-light shadow-sm rounded-3 p-2 text-center">
                <img src="assets/top.png" class="w-100">
                <h2>Visitor's Log</h4>
                <hr>
                <div class="w-100" id="digiclock">

                </div>
            </div>
        </div>

        <div class="bg-light shadow-sm table-responsive">
            <div id="display_table"></div>
        </div>

    </div>
</div>

<!-- MODALS -->
<div class="modal fade" id="ModalMsg" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5">Error</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Please Fill Up
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'modal_qrpass.php'; ?>

<!-- Alertify JS -->
<script src="stylesheets/js/alertify.min.js"></script>
<script src="stylesheets/js/jquery-ui.js"></script>

<script type="text/javascript">
    getClock();
    getLogs();
    getcompany();

    var visitors_name = "";
    var visited_date  = "";
    var visitor_company  = "";

    $("#date_visited").val(formatDate(new Date()));

    $(document).ready(function() {
        function autoComplete() {
            $.post("getautocomplete.php", {}, function(result) {
                var names = JSON.parse(result);

                $("#visitors_name").autocomplete({
                    source: names,
                    select: function(event, ui) {
                        autoSelect(ui.item.value);
                    }
                });
            });
        }

        autoComplete(); // Initialized;

        // When a name is selected.
        function autoSelect(name) {
            $.post("getautocompletedata.php", {name: name}, function(result) {
                var data = JSON.parse(result);

                // $("#visitors_company").val(data[0].company);
                $("#visitors_contact").val(data[0].contact);
            });
        }
    });

    function getcompany() {
        $.post("getcompany.php", {}, function(result) {
            $("#visitors_company").html(result);
            $("#visitors_company").selectpicker('refresh');
        });
    }

    function getClock() {
        $.post('digiclock.php', {}, function(result) {
            $("#digiclock").html(result);
        });
    }

    function getLogs() {
        $.post('getlogs.php', {}, function(result) {
            $("#display_table").html(result);
        });
    }

    function forCounter() {
        select_purpose = $("#select_purpose").val();
        if (select_purpose == "COUNTER") {
            $(".for_counter").removeClass("d-none");
        } else {
            $(".for_counter").addClass("d-none");
        }
    }

    // If company not found
    function ifNotFound() {
        if ($("#notfound").prop("checked")) {
            $("#newcompany").removeClass("d-none").val("");
            $(".dropdown-toggle").addClass("d-none");
            $(".bootstrap-select").addClass("d-none");
            $("#visitors_company").addClass("d-none");
        } else {
            $("#newcompany").addClass("d-none").val("");
            $(".dropdown-toggle").removeClass("d-none");
            $(".bootstrap-select").removeClass("d-none");
            $("#visitors_company").removeClass("d-none");
        }
    }

    function createLog() {
        event.preventDefault();

        visitors_name = $("#visitors_name").val().toUpperCase();
        date_visited = formatDate($("#date_visited").val());
        visitors_company = $("#visitors_company").val();
        newvisitors_company = $("#newcompany").val().replace(/'/g, "\`").replace(/(\r\n|\n|\r)/gm, " ").toUpperCase();
        visitors_contact = $("#visitors_contact").val();
        select_person = $("#select_person").val();
        select_purpose = $("#select_purpose").val();
        visitors_drsi = $("#visitors_drsi").val();

        if (!visitors_name || !visitors_contact || !select_person || !select_purpose) {
            $("#ModalMsg").modal("show");
            $("#ModalMsg .modal-body").html("Fill in blanks.");
            return;
        }

        td_si = $(".for_counter");

        visitors_name = visitors_name;
        visited_date  = date_visited;
        if ($("#notfound").prop("checked")) {
            visitor_company = newvisitors_company;
        } else {
            visitor_company = visitors_company;
        }

        var si_num;
        if (td_si.hasClass("d-none")) {
            si_num = null;
        } else {
            if (!visitors_drsi) {
                $("#ModalMsg").modal("show");
                $("#ModalMsg .modal-body").html("Fill in DR / SI #.");
                return;
            } else {
                si_num = visitors_drsi;
            }
        }

        if ($("#notfound").prop("checked")) {
            if (newvisitors_company == "") {
                $("#ModalMsg").modal("show");
                $("#ModalMsg .modal-body").html("Fill in blanks.");
                return;
            } else {
                company = newvisitors_company;
            }
        } else {
            if (visitors_company == 0) {
                $("#ModalMsg").modal("show");
                $("#ModalMsg .modal-body").html("Select a company.");
                return;
            } else {
                company = visitors_company;
            }
        }

        $.post('insertlog.php', {
            visitors_name: visitors_name,
            date_visited: date_visited,
            visitors_company: company,
            visitors_contact: visitors_contact,
            select_person: select_person,
            select_purpose: select_purpose,
            si_num: si_num
        }, function(result) {
            getLogs();
            getcompany();
            captureImage(visitors_name, visited_date, visitor_company)

            localStorage.setItem("alertShown", "true");
            alertify.set("notifier", "position", "top-center");
            alertify.success(result);

            $("#visitors_name").val("");
            $("#visitors_company").val("");
            $("#visitors_contact").val("");
            $("#select_person").val("");
            $("#select_purpose").val("");
            $("#visitors_drsi").val("");
            $(".for_counter").addClass("d-none");
            $("#barcode_data").prop("autofocus", true);
            $("#notfound").prop("checked", false);

            $(".dropdown-toggle").removeClass("d-none");
            $(".bootstrap-select").removeClass("d-none");
            $("#visitors_company").removeClass("d-none");
            $("#newcompany").addClass("d-none");
        });
    }

    function captureImage(visitors_name, visited_date, visitor_company) {
        const video = document.getElementById('cameraFeed');
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert the canvas to a data URL (base64-encoded image)
        const imageDataUrl = canvas.toDataURL('image/png');

        // Send the captured image data to the server
        $.ajax({
            type: 'POST',
            url: 'save_image.php',
            data: {
                image: imageDataUrl,
                visitors_name: visitors_name,
                visited_date: visited_date,
                visitor_company: visitor_company
            },
            success: function(response) {
                console.log('Image saved successfully:', response);
            },
            error: function(error) {
                console.error('Error saving image:', error);
            }
        });
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');
    }

    $("#barcode_data").keyup(function(e) {
        if (e.keyCode == 13) {
            getBarcode();
        }
    });

    function getBarcode() {
        qrData = $("#barcode_data").val();

        let lastNotificationTime = 0;
        let notificationDelay = 5000;
        let scanningEnabled = true;

        if (!scanningEnabled) {
            return; // Do nothing if scanning is disabled
        }

        // if (!qrData.match(/MBD-/)) {
        if (!/^MBD-(0[1-9]|10)$/.test(qrData)) {
            localStorage.setItem("alertShown", "true");
            alertify.set("notifier", "position", "top-center");
            alertify.error("Unauthorized visitor pass.");
            $("#barcode_data").val("");
            return;
        }

        const currentTime = Date.now();

        if (currentTime - lastNotificationTime >= notificationDelay) {
            // Disable further scans temporarily
            scanningEnabled = false;
            lastNotificationTime = currentTime;

            $.post('getinandout.php', {
                visitorid: qrData
            }, function(result) {
                getLogs();

                localStorage.setItem("alertShown", "true");
                alertify.set("notifier", "position", "top-center");
                alertify.success(result);

                $("#barcode_data").val("");
            });

            // Re-enable scans after the delay
            setTimeout(() => {
                lastNotificationTime = 0;
                scanningEnabled = true;
            }, notificationDelay);
        }
    }

    function viewVisitorPass(mbd) {
        event.preventDefault();

        if (mbd == "") {
            $("#display_qr").attr("src", "./assets/brokenimg.png");
        } else {
            $("#display_qr").attr("src", "./assets/qr/" + mbd + ".jpg");
        }

        $("#ViewQR").modal("show");
    }

</script>

<script type="module">
    import QrScanner from './stylesheets/js/qr-scanner.min.js';
    import * as Worker from './stylesheets/js/qr-scanner-worker.min.js';

    const video = document.getElementById('cameraFeed');
    const camQrResult = document.getElementById('qrdata');

    function setResult(label, result) {
        label.textContent = result.data;
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => 100);

        // Pass the result to your processing function
        processQrResult(result.data);
    }

    const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
        onDecodeError: error => {
            camQrResult.textContent = error;
        },
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });

    scanner.start().then(() => {
        QrScanner.listCameras(true);
    });

    let lastNotificationTime = 0;
    let notificationDelay = 5000;
    let scanningEnabled = true;

    // Function to process the QR code result
    function processQrResult(qrData) {
        if (!scanningEnabled) {
            return; // Do nothing if scanning is disabled
        }

        if (!/^MBD-(0[1-9]|10)$/.test(qrData)) {
            localStorage.setItem("alertShown", "true");
            alertify.set("notifier", "position", "top-center");
            alertify.error("Unauthorized visitor pass.");
            return;
        }

        const currentTime = Date.now();

        if (currentTime - lastNotificationTime >= notificationDelay) {
            // Disable further scans temporarily
            scanningEnabled = false;
            lastNotificationTime = currentTime;

            $.post('getinandout.php', {
                visitorid: qrData
            }, function(result) {
                getLogs();

                localStorage.setItem("alertShown", "true");
                alertify.set("notifier", "position", "top-center");
                alertify.success(result);
            });

            // Re-enable scans after the delay
            setTimeout(() => {
                lastNotificationTime = 0;
                scanningEnabled = true;
            }, notificationDelay);
        }
    }
</script>

</body>
</html>