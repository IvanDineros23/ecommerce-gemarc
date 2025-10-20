
@extends('layouts.app')
@section('content')
@section('title', 'Services | Gemarc Enterprises Incorporated')
@push('styles')
<style>
.svc-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background: linear-gradient(rgba(15,23,42,.78),rgba(15,23,42,.78)), url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;
    opacity: .95;
}
.svc-hero-section {
    position: relative; min-height: 60vh; padding: 5rem 0 6rem; color: #fff; overflow: hidden;
    display: flex; align-items: center; justify-content: center;
}
.svc-hero-content {
    position: relative; z-index: 2; max-width: 900px; margin: 0 auto; text-align: center;
}
.svc-hero-content h1 {
    font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 800; margin-bottom: 1.5rem; letter-spacing: .5px;
}
.svc-hero-content p {
    font-size: 1.15rem; color: #f1f5f9; margin-bottom: 2.5rem;
}
.svc-title-strip {
    background: #222; color: #ffc107; padding: 0.7rem 0; text-align: center; letter-spacing: 2px; font-weight: 700; font-size: 1.3rem; margin-bottom: 0;
}
.svc-title-strip h2 { margin: 0; font-size: 1.3rem; font-weight: 700; letter-spacing: 2px; }
.svc-services-list { background: #fff; padding: 2.5rem 0 2rem; }
.svc-list {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.2rem; max-width: 1100px; margin: 0 auto; padding: 0; list-style: disc inside;
}
.svc-list li { font-size: 1.08rem; color: #222; margin-bottom: .5rem; }
.svc-gallery-wrap { background: #f8fafc; padding: 2.5rem 0; }
.svc-clickable-header { background: #fff; border-radius: 1.2rem; box-shadow: 0 8px 32px -12px rgba(0,0,0,.12); padding: 1.5rem 2rem; margin-bottom: 1.5rem; cursor: pointer; display: flex; flex-direction: column; align-items: center; }
.svc-clickable-header h3 { font-size: 1.3rem; font-weight: 700; margin-bottom: .5rem; color: #222; }
.svc-clickable-header p { color: #555; margin-bottom: .5rem; }
.svc-gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap: 1.2rem; transition: max-height .4s; overflow: hidden; }
.svc-gallery.collapsed { max-height: 0; padding: 0; }
.svc-gallery img { width: 100%; height: 160px; object-fit: cover; border-radius: 1rem; box-shadow: 0 4px 18px -8px rgba(0,0,0,.13); background: #fff; }
@media (max-width: 700px) {
    .svc-hero-content h1 { font-size: 2.2rem; }
    .svc-list { grid-template-columns: 1fr 1fr; }
    .svc-gallery img { height: 120px; }
}
@media (max-width: 480px) {
    .svc-hero-content h1 { font-size: 1.5rem; }
    .svc-list { grid-template-columns: 1fr; }
}
</style>
@endpush

<section class="svc-hero-section">
    <div class="svc-hero-bg"></div>
    <div class="container">
        <div class="svc-hero-content">
            <h1>Repair & Training Services</h1>
            <p>Gemarc Enterprises offers expert repair, maintenance, and training for construction and testing equipment. Our technical team provides on-site diagnostics, preventive maintenance, and hands-on operator training to ensure your equipment runs reliably and safely.</p>
        </div>
    </div>
</section>

<section class="svc-title-strip">
    <div class="container">
        <h2>REPAIR & TRAINING SERVICES</h2>
    </div>
</section>

<section class="svc-services-list">
    <div class="container">
        <ul class="svc-list">
            <li>On-site Diagnostics & Troubleshooting</li>
            <li>Preventive Maintenance for Testing Equipment</li>
            <li>Corrective Repair & Parts Replacement</li>
            <li>Electrical & Mechanical Overhaul</li>
            <li>Load Cell / Sensor Checking & Alignment</li>
            <li>Software/Firmware Configuration & Tuning</li>
            <li>Equipment Commissioning & Start-up Support</li>
            <li>Warranty & Post-warranty Service</li>
            <li>Operator Training (Hands-on)</li>
            <li>Method/Procedure Demo</li>
            <li>Best Practices & Safety Orientation</li>
            <li>Documentation & Test Report Walkthrough</li>
            <li>Refresher Sessions (per request)</li>
            <li>Remote Support & Quick Guidance</li>
        </ul>
    </div>
</section>

<section class="svc-gallery-wrap">
    <div class="container">
        <header class="svc-clickable-header" id="svcDropdownHeader">
            <h3><i class="fas fa-chalkboard-user"></i> Showcase: On-site Demos & Trainings</h3>
            <p>Real sessions conducted by Gemarc technicians</p>
            <span class="chev"><i class="fas fa-chevron-down"></i></span>
        </header>
        <div class="svc-gallery collapsed" id="svcGallery">
            <div class="sg-item"><img src="{{ asset('images/highlights/Pictures/viber_image_2025-09-10_11-40-06-421.jpg') }}" alt="Equipment training"></div>
            <div class="sg-item"><img src="{{ asset('images/highlights/Pictures/viber_image_2025-09-10_11-41-30-552.jpg') }}" alt="Commissioning"></div>
            <div class="sg-item"><img src="{{ asset('images/highlights/Pictures/viber_image_2025-09-10_11-40-06-764.jpg') }}" alt="On-site demo"></div>
            <div class="sg-item"><img src="{{ asset('images/highlights/Pictures/viber_image_2025-09-10_11-45-28-817.jpg') }}" alt="Hands-on session"></div>
            <div class="sg-item"><img src="{{ asset('images/highlights/Pictures/494814749_1916317242538175_7655088993599564921_n.jpg') }}" alt="demo"></div>
            <div class="sg-item"><img src="{{ asset('images/highlights/Pictures/476458768_540083412423925_7677882325727688935_n.jpg') }}" alt="demo"></div>
        </div>

        <!-- Modal for image preview with animation -->
        <style>
        #svcModal {
            display:none;position:fixed;z-index:99999;top:0;left:0;width:100vw;height:100vh;
            background:rgba(20,20,20,0.92);align-items:center;justify-content:center;
            transition:background 0.25s cubic-bezier(.4,0,.2,1);
        }
        #svcModal.show {
            display:flex;
            animation: fadeInBg 0.25s cubic-bezier(.4,0,.2,1);
        }
        @keyframes fadeInBg {
            from { background:rgba(20,20,20,0); }
            to   { background:rgba(20,20,20,0.92); }
        }
        #svcModalImg {
            opacity:0;
            transform: scale(0.96);
            transition: opacity 0.25s cubic-bezier(.4,0,.2,1), transform 0.25s cubic-bezier(.4,0,.2,1);
            max-width:90vw;max-height:80vh;border-radius:1.2rem;box-shadow:0 8px 32px -12px #000;z-index:1000;
        }
        #svcModalImg.visible {
            opacity:1;
            transform: scale(1);
        }
        </style>
        <div id="svcModal">
            <span id="svcModalClose" style="position:absolute;top:30px;right:40px;font-size:2.5rem;color:#fff;cursor:pointer;z-index:1001;">&times;</span>
            <img id="svcModalImg" src="" alt="Preview">
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown for gallery
    var header = document.getElementById('svcDropdownHeader');
    var gallery = document.getElementById('svcGallery');
    var chev = header.querySelector('.chev i');
    header.addEventListener('click', function() {
        gallery.classList.toggle('collapsed');
        chev.classList.toggle('fa-chevron-down');
        chev.classList.toggle('fa-chevron-up');
    });

    // Modal logic with animation
    var modal = document.getElementById('svcModal');
    var modalImg = document.getElementById('svcModalImg');
    var closeBtn = document.getElementById('svcModalClose');
    var imgNodes = Array.from(gallery.querySelectorAll('img'));
    var currentIdx = -1;
    var animating = false;

    function showModalBg() {
        modal.classList.add('show');
    }
    function hideModalBg() {
        modal.classList.remove('show');
        setTimeout(function(){ modal.style.display = 'none'; }, 250);
    }

    function animateImgIn() {
        modalImg.classList.remove('visible');
        setTimeout(function(){ modalImg.classList.add('visible'); }, 10);
    }

    function openModal(idx) {
        if(idx < 0 || idx >= imgNodes.length) return;
        currentIdx = idx;
        modalImg.classList.remove('visible');
        // Animate background
        modal.style.display = 'flex';
        setTimeout(showModalBg, 10);
        // Animate image
        setTimeout(function() {
            modalImg.src = imgNodes[idx].src;
            animateImgIn();
        }, 50);
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        modalImg.classList.remove('visible');
        hideModalBg();
        setTimeout(function(){
            modalImg.src = '';
            document.body.style.overflow = '';
        }, 250);
    }
    function showPrev() {
        if(currentIdx > 0) transitionTo(currentIdx - 1, -1);
    }
    function showNext() {
        if(currentIdx < imgNodes.length - 1) transitionTo(currentIdx + 1, 1);
    }

    // Animate image transition
    function transitionTo(newIdx, dir) {
        if(animating || newIdx < 0 || newIdx >= imgNodes.length) return;
        animating = true;
        modalImg.classList.remove('visible');
        setTimeout(function() {
            modalImg.src = imgNodes[newIdx].src;
            animateImgIn();
            currentIdx = newIdx;
            setTimeout(function(){ animating = false; }, 250);
        }, 250);
    }

    imgNodes.forEach(function(img, idx) {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function(e) {
            e.stopPropagation();
            openModal(idx);
        });
    });
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
        if(e.target === modal) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if(modal.classList.contains('show')) {
            if(e.key === 'Escape') closeModal();
            else if(e.key === 'ArrowLeft') showPrev();
            else if(e.key === 'ArrowRight') showNext();
        }
    });
});
</script>
@endpush
