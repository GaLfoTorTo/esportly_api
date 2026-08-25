import { computed, ref } from 'vue';

const sports = [
    {
        id: 1,
        key: 'futebol',
        label: 'Futebol',
        icon: 'fas fa-futbol',
        color: 'green',
        background: 'green-300',
        video: '/videos/futebol_1.mp4',
        overlay: 'overlay-futebol',
        playbackRate: 0.6,
    },
    {
        id: 2,
        key: 'basquete',
        label: 'Basquete',
        icon: 'fas fa-basketball-ball',
        color: 'orange',
        background: 'orange-500',
        video: '/videos/basquete_1.mp4',
        overlay: 'overlay-basquete',
        playbackRate: 1,
    },
    {
        id: 3,
        key: 'volei',
        label: 'Vôlei',
        icon: 'fas fa-volleyball-ball',
        color: 'bege',
        background: 'bege-300',
        video: '/videos/volei_1.mp4',
        overlay: 'overlay-volei',
        playbackRate: 1,
    },
];

// Estado compartilhado — instanciado uma única vez no módulo
const sportIndex = ref(0);
const transitioning = ref(false);
const sportNextIndex = ref(null);

const sportCurrent = computed(() => sports[sportIndex.value]);
const sportNext    = computed(() => sportNextIndex.value !== null ? sports[sportNextIndex.value] : null);

export function useCurrentSport() {
    const switchSport = (i, onChanged) => {
        if (transitioning.value || i === sportIndex.value) return;
        transitioning.value = true;
        sportNextIndex.value = i;

        setTimeout(() => {
            sportIndex.value = i;
            onChanged?.(sports[i]);
            setTimeout(() => {
                transitioning.value = false;
                sportNextIndex.value = null;
            }, 60);
        }, 650);
    };

    const cycleNext = (onChanged) =>
        switchSport((sportIndex.value + 1) % sports.length, onChanged);

    return {
        sports,
        sportIndex,
        sportCurrent,
        sportNext,
        transitioning,
        switchSport,
        cycleNext,
    };
}
