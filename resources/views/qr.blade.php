@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->user()->hasRole('super admin')||auth()->user()->hasRole('admin'))
        <div class="text-center mt-5">
            <h2>مسح رمز QR</h2>
            <div class="card mx-auto" style="max-width: 400px; margin-left:auto!important;">
                <div class="card-body" >
                    <div id="qr-reader" style="width:100%;"></div>
                    <div id="qr-reader-results" class="mt-3">
                        <!-- سيتم عرض نتائج المسح هنا -->
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger mt-5">
            <p>ليس لديك صلاحية الوصول إلى هذه الصفحة.</p>
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
            // إخفاء محتوى رمز QR الخام (تم التعليق على هذا السطر)
            // document.getElementById('qr-reader-results').innerText = `تم الكشف عن رمز QR: ${qrCodeMessage}`;
            
            // إرسال رمز QR إلى الخادم للتحقق
            verifyQrCode(qrCodeMessage);
        }

        function verifyQrCode(qrCode) {
            $.ajax({
                url: '{{ route("admin.verifyCard") }}', // تعديل الرابط حسب مسارك
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    qr_code: qrCode
                },
                success: function(response) {
                    var resultElement = document.getElementById('qr-reader-results');
                    if (response.exists && response.approved) {
                        resultElement.innerHTML = '<div class="alert alert-success">البطاقة معتمدة وصالحة.</div>';
                    } else if (response.exists) {
                        resultElement.innerHTML = '<div class="alert alert-warning">تم العثور على البطاقة لكنها غير معتمدة.</div>';
                    } else {
                        resultElement.innerHTML = '<div class="alert alert-danger">لم يتم العثور على البطاقة.</div>';
                    }
                },
                error: function() {
                    document.getElementById('qr-reader-results').innerHTML = '<div class="alert alert-danger">حدث خطأ أثناء التحقق من البطاقة.</div>';
                }
            });
        }

        html5QrCode.start(
            { facingMode: "environment" }, // استخدام الكاميرا الخلفية
            {
                fps: 10, // عدد الإطارات في الثانية لمسح رمز QR
                qrbox: { width: 250, height: 250 } // إطار المسح لرمز QR
            },
            onScanSuccess // وظيفة الاسترجاع عند مسح رمز QR
        ).catch(err => {
            console.error("غير قادر على بدء المسح", err);
            document.getElementById('qr-reader-results').innerText = 'بث الكاميرا غير مدعوم بواسطة متصفحك.';
        });
    });
</script>
@endpush
