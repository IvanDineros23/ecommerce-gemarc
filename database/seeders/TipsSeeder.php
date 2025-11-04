<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tip;

class TipsSeeder extends Seeder
{
    public function run()
    {
        $tips = [
            [
                'title' => 'Equipment Calibration Reminder',
                'content' => 'Regular calibration of testing equipment is essential for accurate results. Schedule calibration services at least once every 6 months to maintain precision and compliance with international standards.',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Product Quotation Guide',
                'content' => 'For faster quotation processing:<br>
                • Specify the exact model number<br>
                • Include desired quantity<br>
                • Mention your preferred delivery timeline<br>
                • Indicate any special requirements or certifications needed',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Bulk Order Benefits',
                'content' => 'Take advantage of our bulk order discounts:<br>
                • Special pricing for orders above ₱500,000<br>
                • Priority handling and shipping<br>
                • Dedicated account manager<br>
                • Extended warranty options',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Technical Support Hours',
                'content' => 'Our technical support team is available:<br>
                • Monday to Friday: 8:00 AM - 5:00 PM<br>
                • Saturday: 8:00 AM - 12:00 PM<br>
                For urgent assistance, contact our 24/7 hotline: +63 909 087 9416',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Material Storage Guidelines',
                'content' => 'Proper storage ensures material quality:<br>
                • Store cement in dry, elevated areas<br>
                • Keep aggregates covered and segregated<br>
                • Protect steel from moisture and direct ground contact<br>
                • Maintain proper ventilation in storage areas',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Sample Testing Service',
                'content' => 'Get accurate material testing results:<br>
                • Submit minimum required sample quantities<br>
                • Use proper sampling methods<br>
                • Include complete sample identification<br>
                • Schedule tests at least 24 hours in advance',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'title' => 'Equipment Maintenance Tips',
                'content' => 'Extend the life of your testing equipment:<br>
                • Clean after each use<br>
                • Check calibration regularly<br>
                • Keep detailed maintenance logs<br>
                • Report any irregularities immediately',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'title' => 'Document Requirements',
                'content' => 'For smooth transaction processing, prepare:<br>
                • Valid company ID or authorization letter<br>
                • Purchase order with complete details<br>
                • Shipping/delivery address<br>
                • Tax identification number (TIN)',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'title' => 'Quality Certification',
                'content' => 'Our materials and equipment comply with:<br>
                • ISO 9001:2015 Quality Management<br>
                • ASTM International Standards<br>
                • Philippine National Standards<br>
                • CE Marking for applicable products',
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'title' => 'Payment Methods',
                'content' => 'We accept the following payment options:<br>
                • Bank transfer<br>
                • Company checks<br>
                • Letter of credit (for international orders)<br>
                • Terms available for qualified accounts',
                'is_active' => true,
                'sort_order' => 10
            ],
            [
                'title' => 'Shipping Information',
                'content' => 'Delivery services available:<br>
                • Metro Manila: 1-2 business days<br>
                • Provincial: 3-5 business days<br>
                • Special handling for sensitive equipment<br>
                • Nationwide delivery network',
                'is_active' => true,
                'sort_order' => 11
            ],
            [
                'title' => 'Training Services',
                'content' => 'Enhance your team\'s expertise:<br>
                • Equipment operation training<br>
                • Material testing workshops<br>
                • Quality control seminars<br>
                • Certification programs available',
                'is_active' => true,
                'sort_order' => 12
            ]
        ];

        foreach ($tips as $tip) {
            Tip::create($tip);
        }
    }
}