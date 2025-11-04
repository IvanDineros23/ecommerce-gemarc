<div x-data="{
    currentTip: 0,
    tips: @json($tips),
    autoplayInterval: null,
    
    init() {
        if (this.tips.length > 0) {
            this.startAutoplay();
        }
    },
    
    nextTip() {
        this.currentTip = (this.currentTip + 1) % this.tips.length;
    },
    
    prevTip() {
        this.currentTip = (this.currentTip - 1 + this.tips.length) % this.tips.length;
    },
    
    startAutoplay() {
        this.autoplayInterval = setInterval(() => {
            this.nextTip();
        }, 5000); // Change tip every 5 seconds
    },
    
    pauseAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
        }
    },
    
    resumeAutoplay() {
        this.startAutoplay();
    }
}" 
class="bg-white shadow-lg rounded-lg p-4 relative overflow-hidden"
@mouseover="pauseAutoplay"
@mouseleave="resumeAutoplay">
    @if(count($tips) > 0)
        <div class="flex flex-col space-y-2">
            <div class="text-lg font-semibold text-gray-800 mb-2">Tips & Reminders</div>
            
            <template x-for="(tip, index) in tips" :key="index">
                <div x-show="currentTip === index"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform -translate-x-full"
                     class="py-2">
                    <p class="text-gray-600" x-text="tip.content"></p>
                </div>
            </template>
            
            <!-- Navigation dots -->
            <div class="flex justify-center space-x-2 mt-4">
                <template x-for="(tip, index) in tips" :key="index">
                    <button @click="currentTip = index"
                            :class="{'bg-blue-500': currentTip === index, 'bg-gray-300': currentTip !== index}"
                            class="w-2 h-2 rounded-full transition-colors duration-200">
                    </button>
                </template>
            </div>
        </div>
        
        <!-- Navigation buttons -->
        <button @click="prevTip" 
                class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        
        <button @click="nextTip"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    @else
        <p class="text-gray-500">No tips available at the moment.</p>
    @endif
</div>