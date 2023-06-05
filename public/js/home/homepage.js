var emblaNode = document.querySelector('.embla')
var options = {
    loop: true,
    skipSnaps: true,
    speed: 10,
}
var plugins = [EmblaCarouselAutoplay()] // Plugins

const rootNode = document.querySelector('.embla')
const viewportNode = rootNode.querySelector('.embla__viewport')

const prevButtonNode = rootNode.querySelector('.embla__prev')
const nextButtonNode = rootNode.querySelector('.embla__next')

const embla = EmblaCarousel(viewportNode, options, plugins)


// Opacidade

const TWEEN_FACTOR = 4.2

const numberWithinRange = (number, min, max) =>
    Math.min(Math.max(number, min), max)

const calculateTweenValuesOpacity = (embla) => {
    const engine = embla.internalEngine()
    const scrollProgress = embla.scrollProgress()

    return embla.scrollSnapList().map((scrollSnap, index) => {
        if (!embla.slidesInView().includes(index)) return 0
        let diffToTarget = scrollSnap - scrollProgress

        if (engine.options.loop) {
            engine.slideLooper.loopPoints.forEach((loopItem) => {
                const target = loopItem.target()
                if (index === loopItem.index && target !== 0) {
                    const sign = Math.sign(target)
                    if (sign === -1) diffToTarget = scrollSnap - (1 + scrollProgress)
                    if (sign === 1) diffToTarget = scrollSnap + (1 - scrollProgress)
                }
            })
        }
        const tweenValue = 1 - Math.abs(diffToTarget * TWEEN_FACTOR)
        return numberWithinRange(tweenValue, 0, 1)
    })
}

const setupTweenOpacity = (embla) => {
    const tweenNodes = embla.slideNodes()

    const applyTweenOpacity = () => {
        const tweenValues = calculateTweenValuesOpacity(embla)
        tweenValues.forEach((tweenValue, index) => {
            tweenNodes[index].style.opacity = tweenValue.toString()
        })
    }

    const removeTweenOpacity = () => {
        tweenNodes.forEach((slide) => slide.removeAttribute('style'))
    }

    return {
        applyTweenOpacity,
        removeTweenOpacity,
    }
}



const { applyTweenOpacity, removeTweenOpacity } = setupTweenOpacity(embla)
embla
    .on('init', applyTweenOpacity)
    .on('scroll', applyTweenOpacity)
    .on('reInit', applyTweenOpacity)
    .on('destroy', removeTweenOpacity)

prevButtonNode.addEventListener('click', embla.scrollPrev, false)
nextButtonNode.addEventListener('click', embla.scrollNext, false)

