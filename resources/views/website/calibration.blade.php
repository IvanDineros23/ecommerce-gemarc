@extends('layouts.app')
@section('content')
@section('title', 'Calibration | Gemarc Enterprises Incorporated')
@push('styles')
<style>
.calib-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background: linear-gradient(rgba(15,23,42,.78),rgba(15,23,42,.78)), url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;
    opacity: .95;
}
.calib-hero-section {
    position: relative; min-height: 60vh; padding: 5rem 0 6rem; color: #fff; overflow: hidden;
    display: flex; align-items: center; justify-content: center;
}
.calib-hero-content {
    position: relative; z-index: 2; max-width: 900px; margin: 0 auto; text-align: center;
}
.calib-hero-content h1 {
    font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 800; margin-bottom: 1.5rem; letter-spacing: .5px;
}
.calib-hero-content p {
    font-size: 1.15rem; color: #f1f5f9; margin-bottom: 2.5rem;
}
.calib-title-strip {
    background: #222; color: #ffc107; padding: 0.7rem 0; text-align: center; letter-spacing: 2px; font-weight: 700; font-size: 1.3rem; margin-bottom: 0;
}
.calib-title-strip h2 { margin: 0; font-size: 1.3rem; font-weight: 700; letter-spacing: 2px; }
.calib-services-list { background: #fff; padding: 2.5rem 0 2rem; }
.calib-list {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.2rem; max-width: 1100px; margin: 0 auto; padding: 0; list-style: disc inside;
}
.calib-list li { font-size: 1.08rem; color: #222; margin-bottom: .5rem; }
.calib-gallery-wrap { background: #f8fafc; padding: 2.5rem 0; }
.clickable-header { background: #fff; border-radius: 1.2rem; box-shadow: 0 8px 32px -12px rgba(0,0,0,.12); padding: 1.5rem 2rem; margin-bottom: 1.5rem; cursor: pointer; display: flex; flex-direction: column; align-items: center; }
.clickable-header h3 { font-size: 1.3rem; font-weight: 700; margin-bottom: .5rem; color: #222; }
.clickable-header p { color: #555; margin-bottom: .5rem; }
.calib-gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap: 1.2rem; transition: max-height .4s; overflow: hidden; }
.calib-gallery.collapsed { max-height: 0; padding: 0; }
.calib-gallery img { width: 100%; height: 160px; object-fit: cover; border-radius: 1rem; box-shadow: 0 4px 18px -8px rgba(0,0,0,.13); background: #fff; }
@media (max-width: 700px) {
    .calib-hero-content h1 { font-size: 2.2rem; }
    .calib-list { grid-template-columns: 1fr 1fr; }
    .calib-gallery img { height: 120px; }
}
@media (max-width: 480px) {
    .calib-hero-content h1 { font-size: 1.5rem; }
    .calib-list { grid-template-columns: 1fr; }
}
</style>
@endpush

<section class="calib-hero-section">
    <div class="calib-hero-bg"></div>
    <div class="container">
        <div class="calib-hero-content">
            <h1>Professional Calibration Services</h1>
            <p>At Gemarc Enterprises, we provide comprehensive calibration services for construction and materials testing equipment. Our team of certified technicians ensures that your equipment meets the highest standards of accuracy and reliability.</p>
        </div>
    </div>
</section>

<section class="calib-title-strip">
    <div class="container">
        <h2>CALIBRATION SERVICES</h2>
    </div>
</section>

<section class="calib-services-list">
    <div class="container">
        <ul class="calib-list">
            <li>Concrete Batching Plant</li>
            <li>Asphalt Batching Plant</li>
            <li>Stressing Jacks</li>
            <li>Rebound Hammer</li>
            <li>Digital/Analog Balance</li>
            <li>Speedy Moisture</li>
            <li>Laboratory Oven</li>
            <li>Compression Machine</li>
            <li>Universal Testing Machine</li>
            <li>Air Meter</li>
            <li>CBR Machine</li>
            <li>Marshall Machine</li>
            <li>Water Bath</li>
            <li>Unconfined Machine</li>
            <li>Direct Shear Tester</li>
            <li>Odometer</li>
            <li>Thermometer</li>
            <li>Moisture Cabinet</li>
            <li>LA Machine</li>
            <li>Muffle Furnace</li>
            <li>Caliper</li>
            <li>Dial Gauge</li>
            <li>Melting Pot</li>
            <li>Dynamic Cone Penetrometer</li>
            <li>Vicat Apparatus</li>
            <li>Penetrometer Apparatus</li>
            <li>Length Comparator</li>
            <li>Autoclave</li>
            <li>Water Refrigerator</li>
            <li>Cooling Device</li>
            <li>Micro Computer Ring Crush Tester</li>
            <li>Box Tester</li>
            <li>Micro Tensile Tester</li>
        </ul>
    </div>
</section>

<section class="calib-gallery-wrap">
    <div class="container">
        <header class="clickable-header" id="calibDropdownHeader">
            <h3><i class="fas fa-images"></i> Showcase: Recent Calibration Work</h3>
            <p>Proof of completed calibrations by our technical team</p>
            <span class="chev"><i class="fas fa-chevron-down"></i></span>
        </header>
        <div class="calib-gallery collapsed" id="calibGallery">
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-34-126.jpg') }}" alt="Calibration 1"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-34-214.jpg') }}" alt="Calibration 2"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-34-308.jpg') }}" alt="Calibration 3"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-34-718.jpg') }}" alt="Calibration 4"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-34-788.jpg') }}" alt="Calibration 5"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-34-898.jpg') }}" alt="Calibration 6"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-35-027.jpg') }}" alt="Calibration 7"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-10_11-40-05-229.jpg') }}" alt="Calibration 8"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-10_11-40-06-130.jpg') }}" alt="Calibration 9"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/492944049_610384578694078_3648091509823792302_n.jpg') }}" alt="Calibration 10"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/504268189_640204125712123_6277874478571758863_n.jpg') }}" alt="Calibration 11"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/504428235_640204199045449_4608588939321091082_n.jpg') }}" alt="Calibration 12"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/504428926_640204169045452_5758812348746634334_n.jpg') }}" alt="Calibration 13"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/505596594_640204202378782_8321184957891935740_n.jpg') }}" alt="Calibration 14"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/505748620_640204149045454_5713118671588066311_n.jpg') }}" alt="Calibration 15"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/518278555_669110816154787_8607938420397116506_n.jpg') }}" alt="Calibration 16"></div>
            <div class="cg-item"><img src="{{ asset('images/highlights/calibration/518296567_669110862821449_8469632100392611821_n.jpg') }}" alt="Calibration 17"></div>
        </div>

        <!-- Modal for image preview with animation -->
        <style>
        #calibModal {
            display:none;position:fixed;z-index:99999;top:0;left:0;width:100vw;height:100vh;
            background:rgba(20,20,20,0.92);align-items:center;justify-content:center;
            transition:background 0.25s cubic-bezier(.4,0,.2,1);
        }
        #calibModal.show {
            display:flex;
            animation: fadeInBg 0.25s cubic-bezier(.4,0,.2,1);
        }
        @keyframes fadeInBg {
            from { background:rgba(20,20,20,0); }
            to   { background:rgba(20,20,20,0.92); }
        }
        #calibModalImg {
            opacity:0;
            transform: scale(0.96);
            transition: opacity 0.25s cubic-bezier(.4,0,.2,1), transform 0.25s cubic-bezier(.4,0,.2,1);
            max-width:90vw;max-height:80vh;border-radius:1.2rem;box-shadow:0 8px 32px -12px #000;z-index:1000;
        }
        #calibModalImg.visible {
            opacity:1;
            transform: scale(1);
        }
        </style>
        <div id="calibModal">
            <span id="calibModalClose" style="position:absolute;top:30px;right:40px;font-size:2.5rem;color:#fff;cursor:pointer;z-index:1001;">&times;</span>
            <img id="calibModalImg" src="" alt="Preview">
        </div>
    </div>
</section>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown for gallery
    var header = document.getElementById('calibDropdownHeader');
    var gallery = document.getElementById('calibGallery');
    var chev = header.querySelector('.chev i');
    header.addEventListener('click', function() {
        gallery.classList.toggle('collapsed');
        chev.classList.toggle('fa-chevron-down');
        chev.classList.toggle('fa-chevron-up');
    });

    // Modal logic with animation
    var modal = document.getElementById('calibModal');
    var modalImg = document.getElementById('calibModalImg');
    var closeBtn = document.getElementById('calibModalClose');
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

@endsection