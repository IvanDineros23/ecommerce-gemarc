// Aggregates page modal logic extracted to external file to avoid inline parsing issues
(function(){
  function qs(id){ return document.getElementById(id); }

  function openProductModal(product){
    var img = qs('modalProductImage');
    if (!img) return;
    img.src = product.image;
    img.alt = product.code + ' ' + product.name;
    var codeBadge = qs('modalProductCodeBadge');
    if (codeBadge) codeBadge.textContent = product.code;
    var nameEl = qs('modalProductName');
    if (nameEl) nameEl.textContent = product.name;
    var stdEl = qs('modalProductStandard');
    if (stdEl) stdEl.textContent = product.standard || '';
    var descEl = qs('modalProductDescription');
    if (descEl) descEl.textContent = product.description || '';
    var mfgEl = qs('modalProductManufacturer');
    if (mfgEl) mfgEl.textContent = product.manufacturer || 'Gemarc Enterprises Inc.';

    var inq = qs('inquiryProduct');
    if (inq) inq.value = product.code + ' - ' + product.name;

    var specsGrid = qs('modalSpecsGrid');
    if (specsGrid){
      specsGrid.innerHTML = '';
      if (product.specs && product.specs.length){
        product.specs.forEach(function(spec){
          var d = document.createElement('div');
          d.className = 'modal-spec-item';
          d.innerHTML = '<div class="modal-spec-label">'+spec.label+'</div>' +
                        '<div class="modal-spec-value">'+spec.value+'</div>';
          specsGrid.appendChild(d);
        });
      } else {
        specsGrid.innerHTML = '<p>No detailed specifications available. Please refer to the PDF documentation or contact us for more information.</p>';
      }
    }

    var modal = qs('productModal');
    if (modal){
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeProductModal(){
    var modal = qs('productModal');
    if (modal) modal.classList.remove('active');
    document.body.style.overflow = '';
    var iform = qs('inquiryForm');
    if (iform) iform.style.display = 'none';
  }

  function showInquiryForm(){
    var form = qs('inquiryForm');
    if (!form) return;
    form.style.display = (form.style.display === 'none' || !form.style.display) ? 'block' : 'none';
  }

  // attach global
  window.openProductModal = openProductModal;
  window.closeProductModal = closeProductModal;
  window.showInquiryForm = showInquiryForm;

  // Close behaviors
  document.addEventListener('DOMContentLoaded', function(){
    var modal = qs('productModal');
    if (modal){
      modal.addEventListener('click', function(evt){ if (evt.target === modal) closeProductModal(); });
    }
    document.addEventListener('keydown', function(evt){ if (evt.key === 'Escape') closeProductModal(); });
  });

  // Product specific openers (absolute paths from public root)
  function i(p){ return '/images/highlights/' + p; }

  window.openA024NModal = function(){
    openProductModal({
      code:'A024N',
      name:'Ceramic Muffle Furnace',
      standard:'EN 196-2, EN 196-21, EN 459-2',
      description:'Used to determine the loss on ignition of cement and lime; chloride, carbon dioxide, alkali content of cement.',
      image: i('A024N.jpg'),
      manufacturer:'MATEST',
      pdf:'/downloadable content/A024N.pdf',
      specs:[
        {label:'Temperature Range', value:'Up to 1100°C'},
        {label:'Chamber Size', value:'300 x 200 x 100 mm'},
        {label:'Heating Elements', value:'Silicon Carbide'},
        {label:'Controller', value:'Digital PID controller'},
        {label:'Accuracy', value:'±2°C'},
        {label:'Power Supply', value:'230V, 50/60Hz'},
        {label:'Power', value:'3.5 kW'},
        {label:'Safety Features', value:'Over-temp protection, door safety switch'}
      ]
    });
  };

  window.openA075NModal = function(){
    openProductModal({
      code:'A075N',
      name:'LOS ANGELES ABRASION MACHINE',
      standard:'ASTM C131, EN 12697-17, EN 12697-43, NF P18-573, AASHTO T96, CNR N. 34',
      description:'Used to determine the resistance of aggregates to abrasion.',
      image: i('A075N.jpg'),
      manufacturer:'MATEST',
      pdf:'/downloadable content/A075N.pdf',
      specs:[
        {label:'Cylinder Dimensions', value:'711 mm (ID) x 508 mm (Length)'},
        {label:'Rotation Speed', value:'31-33 rpm'},
        {label:'Material', value:'Heavy steel construction'},
        {label:'Drive', value:'Gear motor with speed reducer'},
        {label:'Counter', value:'Automatic digital counter, presettable'},
        {label:'Filling Opening', value:'Counterbalanced, push-button positioning'},
        {label:'Control Panel', value:'Wall fixed or bench placed'},
        {label:'Power Supply', value:'230V 50Hz 1ph 750W'},
        {label:'Dimensions', value:'1000x800x1000 mm'},
        {label:'Weight', value:'370 kg approx.'}
      ]
    });
  };

  window.openA125NModal = function(){
    openProductModal({
      code:'A125N',
      name:'Digital Point Load Tester 56 KN (ROCK STRENGTH INDEX)',
      standard:'ASTM D5731, ISRM',
      description:'Used to determine the strength values of a rock specimen both in the field and in the laboratory.',
      image: i('A125N.jpg'),
      manufacturer:'MATEST',
      pdf:'/downloadable content/A125N.pdf',
      specs:[
        {label:'Load Cell', value:'High precision electric'},
        {label:'Capacity', value:'56 kN (100 kN mod. A126)'},
        {label:'Max Core Specimen', value:'4" (101.6 mm)'},
        {label:'Distance Reading', value:'Graduated scale'},
        {label:'Display Unit', value:'Digital, 0-56 kN, 65,000 divisions, 0.001 kN resolution'},
        {label:'Linearity', value:'0.05%'},
        {label:'Hysteresis', value:'0.03%'},
        {label:'Repeatability', value:'0.02%'},
        {label:'Supplied With', value:'Wooden carrying case, goggles, accessories'},
        {label:'Dimensions', value:'370x520x720 mm'},
        {label:'Weight', value:'28 kg approx.'}
      ]
    });
  };

  window.openNL1002X002Modal = function(){
    openProductModal({
      code:'NL 1002 X / 002',
      name:'Aggregate Impact Value Apparatus (AIV)',
      standard:'BS 812, NF P18-574',
      description:'Used to determine the aggregate impact value by measuring the resistance of an aggregate to sudden impact or shock loading.',
      image: i('nl1002x002-01.jpg'),
      manufacturer:'NL Scientific',
      pdf:'/downloadable content/NL 1002 X _ 002.pdf',
      specs:[
        {label:'Dimensions', value:'470 (L) x 330 (W) x 850 (H)'},
        {label:'Weight', value:'48 kg'}
      ]
    });
  };

  window.openNL1015X011Modal = function(){
    openProductModal({
      code:'NL 1015 X / 011',
      name:'Sieve Shaker, Triple Motion (From 200 up to 450 mm Dia.)',
      standard:'EN 932-5, ISO 3310-1, ASTM C136',
      description:'Triple motion functionality incorporating vertical, horizontal, and rotational motions for thorough and efficient sieving.',
      image: i('NL-1015-X-011.jpg'),
      manufacturer:'NL Scientific',
      pdf:'/downloadable content/NL 1015 X _ 011.pdf',
      specs:[
        {label:'Model Number', value:'NL 1015 X / 009A'},
        {label:'Accommodates', value:'11 nos 200mm/8" Dia. Full Height Sieves plus lid and receiver, 9 nos 300mm/12" Dia. Full Height Sieves plus lid and receiver, 7 nos. 450mm Dia. Full Height Sieves plus lid and pan'},
        {label:'Timer', value:'1 - 60 min'},
        {label:'Dimensions (mm)', value:'585 (L) x 460 (W) x 1250 (H)'},
        {label:'Weight', value:'105 kg approx.'},
        {label:'Power', value:'220V, 1ph, 1/2 Hp, 50/60 Hz, 375W'},
        {label:'Motion Types', value:'Vertical, Horizontal, and Rotational'},
        {label:'Speed Control', value:'Variable speed control'},
        {label:'Features', value:'Digital timer, Low noise pollution, Quick clamping & release mechanism'},
        {label:'Construction', value:'Durable materials for continuous laboratory use'},
        {label:'Included Parts', value:'Clamping Knobs (Pair), Clamping Beam, Threaded Column Set, Manual Instruction'},
        {label:'Optional Accessories', value:'Noise Reduction Cabinet (NL 1015 X / SPC)'}
      ]
    });
  };

  window.openNL1003XModal = function(){
    openProductModal({
      code:'NL 1003 X',
      name:'Bulk Density Measure',
      standard:'ASTM C29, BS EN 1097-3',
      description:'Steel constructed with handles for capacity 1 litre and above. Used to determine the loose bulk density and void of aggregate.',
      image: i('NL-1003-X.jpg'),
      manufacturer:'NL Scientific',
      pdf:'/downloadable content/NL 1003 X.pdf',
      specs:[
        {label:'Construction', value:'Steel with handles'},
        {label:'Application', value:'Determination of loose bulk density and void of aggregate'},
        {label:'BS EN 1097-3 Models', value:'1L (NL 1003 X / 001), 5L (NL 1003 X / 002), 10L (NL 1003 X / 003), 20L (NL 1003 X / 004)'},
        {label:'ASTM C29 Models', value:'14L (NL 1003 X / 005), 28L (NL 1003 X / 007), 2.8L (NL 1003 X / 010), 9.3L (NL 1003 X / 011)'},
        {label:'Additional Accessories', value:'Straight Edge 300x30x3mm (NL 5001 X / 001 - A 023), Glass Plate 300x300x8mm (NL 7030 G / 002)'},
        {label:'Capacity Range', value:'1 litre to 28 litres'},
        {label:'Standards Compliance', value:'ASTM C29 and BS EN 1097-3'},
        {label:'Material', value:'Durable steel construction'},
        {label:'Handle Design', value:'Ergonomic handles for easy handling'},
        {label:'Applications', value:'Construction materials testing, aggregate quality control, concrete mix design'}
      ]
    });
  };

  window.openLDO060EModal = function(){
    openProductModal({
      code:'LDO-060E',
      name:'Natural Convection Oven',
      standard:'Advanced Temperature Control & Natural Convection',
      description:'Stainless Steel chamber for excellent corrosion resistance and easy cleaning. Natural convection of heated air without a separate fan.',
      image: i('LDO-060E.jpg'),
      manufacturer:'LabTech BioMedic',
      pdf:'/downloadable content/LDO-060E.pdf',
      specs:[
        {label:'Temperature Range', value:'Ambient +5°C to 250°C Max.'},
        {label:'Temperature Accuracy', value:'±1.0°C'},
        {label:'Temperature Uniformity', value:'±5.0°C at 120°C'},
        {label:'Display', value:'LED 4 Digit display'},
        {label:'Interior Material', value:'Stainless steel polished'},
        {label:'Exterior Material', value:'Epoxy powder coated steel'},
        {label:'Insulation', value:'Glass wool'},
        {label:'Shelves', value:'2 EA'},
        {label:'Safety Features', value:'Over temperature protection, Electric leakage circuit breaker'},
        {label:'Electric Supply', value:'110 V, 60 Hz or 220 V, 50 or 60 Hz, 1 Phase'}
      ]
    });
  };

  window.openLBD2045DModal = function(){
    openProductModal({
      code:'LBD-2045D',
      name:'Hotplate & Stirrer',
      standard:'High Density Ceramic Coating & Temperature Control',
      description:'High density ceramic coated stainless steel top plate for excellent chemical resistance. Durable heater with excellent heat transfer.',
      image: i('LBD-2045-D.jpg'),
      manufacturer:'LabTech BioMedic',
      pdf:'/downloadable content/LBD-2045D.pdf',
      specs:[
        {label:'Top Plate', value:'High density ceramic coated stainless steel'},
        {label:'Temperature Range', value:'Room temperature to 380°C'},
        {label:'Stirring Speed', value:'60-1500 rpm'},
        {label:'Top Plate Size', value:'180 x 180 mm'},
        {label:'Heating Power', value:'600W'}
      ]
    });
  };

  window.openLWB111DModal = function(){
    openProductModal({
      code:'LWB-111D',
      name:'Digital Water Bath',
      standard:'Stainless Steel Construction & Auto Tuning',
      description:'Seamless stainless-steel bath for excellent corrosion resistance and easy cleaning.',
      image: i('LWB-111D.jpg'),
      manufacturer:'LabTech BioMedic',
      pdf:'/downloadable content/LWB-111D.pdf',
      specs:[
        {label:'Timer', value:'99 hr. 59 min. / Continuous with end alarm'},
        {label:'Temperature Range', value:'Ambient + 5°C to 99°C'},
        {label:'Power Supply', value:'220 V 50/60 Hz, 1 Phase'}
      ]
    });
  };
})();
