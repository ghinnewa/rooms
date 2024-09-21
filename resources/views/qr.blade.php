@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->user()->hasRole('super admin')||auth()->user()->hasRole('admin'))
        <div class="text-center mt-5">
            <h2>Scan QR Code</h2>
            <div class="card mx-auto" style="max-width: 400px;">
                <div class="card-body">
                    <div id="qr-reader" style="width:100%;"></div>
                    <div id="qr-reader-results" class="mt-3">
                        <!-- The results of the scan will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger mt-5">
            <p>You do not have access to this page.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var html5QrCode = new Html5Qrcode("qr-reader");

        function onScanSuccess(qrCodeMessage) {
            // Hide the raw QR code content (commenting out this line)
            // document.getElementById('qr-reader-results').innerText = `QR Code detected: ${qrCodeMessage}`;
            
            // Send the QR code to the server for verification
            verifyQrCode(qrCodeMessage);
        }

        function verifyQrCode(qrCode) {
            $.ajax({
                url: '{{ route("admin.verifyCard") }}', // Adjust this to your route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    qr_code: qrCode
                },
                success: function(response) {
                    var resultElement = document.getElementById('qr-reader-results');
                    if (response.exists && response.approved) {
                        resultElement.innerHTML = '<div class="alert alert-success">Card is approved and valid.</div>';
                    } else if (response.exists) {
                        resultElement.innerHTML = '<div class="alert alert-warning">Card is found but not approved.</div>';
                    } else {
                        resultElement.innerHTML = '<div class="alert alert-danger">Card not found.</div>';
                    }
                },
                error: function() {
                    document.getElementById('qr-reader-results').innerHTML = '<div class="alert alert-danger">Error occurred while verifying the card.</div>';
                }
            });
        }

        html5QrCode.start(
            { facingMode: "environment" }, // Use the back camera
            {
                fps: 10, // Frame per second for QR code scanning
                qrbox: { width: 250, height: 250 } // Bounding box for QR code scanning
            },
            onScanSuccess // The callback function when a QR code is scanned
        ).catch(err => {
            console.error("Unable to start scanning", err);
            document.getElementById('qr-reader-results').innerText = 'Camera streaming is not supported by your browser.';
        });
    });
</script>
@endpush
