import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('homeVideoSlider', (slides = []) => ({
    slides,
    active: 0,
    modalOpen: false,
    modalSlide: null,
    timer: null,
    slideStepPx: 0,

    init() {
        this.$nextTick(() => {
            this.measureStep();
            window.addEventListener('resize', () => this.measureStep());
        });
        this.startAutoplay();
    },

    measureStep() {
        const card = this.$el.querySelector('.video-slider-card');
        const track = this.$el.querySelector('.video-slider-track');

        if (!card || !track) {
            return;
        }

        const gap = Number.parseFloat(getComputedStyle(track).gap || '16');

        this.slideStepPx = card.offsetWidth + gap;
    },

    startAutoplay() {
        this.stopAutoplay();
        if (this.slides.length <= 1 || this.modalOpen) {
            return;
        }

        this.timer = setInterval(() => {
            if (!this.modalOpen) {
                this.active = (this.active + 1) % this.slides.length;
            }
        }, 4500);
    },

    stopAutoplay() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },

    goTo(index) {
        this.active = index;
        this.startAutoplay();
    },

    openModal(slide) {
        this.modalSlide = slide;
        this.modalOpen = true;
        this.stopAutoplay();
        document.body.classList.add('overflow-hidden');
    },

    closeModal() {
        this.modalOpen = false;
        this.modalSlide = null;
        document.body.classList.remove('overflow-hidden');
        this.startAutoplay();
    },

    modalEmbedUrl(slide) {
        if (!slide?.embed) {
            return '';
        }

        const separator = slide.embed.includes('?') ? '&' : '?';

        return `${slide.embed}${separator}autoplay=1`;
    },
}));

Alpine.start();

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
);

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
});
