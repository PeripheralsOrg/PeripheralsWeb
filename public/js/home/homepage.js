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

prevButtonNode.addEventListener('click', embla.scrollPrev, false)
nextButtonNode.addEventListener('click', embla.scrollNext, false)



// CARROSSEL PRODUTO

var emblaNodeProduto = document.querySelector('.produto-carrossel')

var options = {
    loop: true,
    speed: 5,
}
var plugins = [EmblaCarouselAutoplay()] // Plugins

const rootNodeProduto = emblaNodeProduto;
const viewportNodeProduto = rootNodeProduto.querySelector('.embla__viewport')

const emblaProduto = EmblaCarousel(viewportNodeProduto, options, plugins)


const TWEEN_FACTOR = 4.2

const numberWithinRange = (number, min, max) =>
    Math.min(Math.max(number, min), max)

const calculateTweenValuesOpacity = (emblaProduto) => {
    const engine = emblaProduto.internalEngine()
    const scrollProgress = emblaProduto.scrollProgress()

    return emblaProduto.scrollSnapList().map((scrollSnap, index) => {
        if (!emblaProduto.slidesInView().includes(index)) return 0
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

const setupTweenOpacity = (emblaProduto) => {
    const tweenNodes = emblaProduto.slideNodes()

    const applyTweenOpacity = () => {
        const tweenValues = calculateTweenValuesOpacity(emblaProduto)
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

const prevButtonNodeProduto = rootNodeProduto.querySelector('.embla__prev')
const nextButtonNodeProduto = rootNodeProduto.querySelector('.embla__next')

prevButtonNode.addEventListener('click', emblaProduto.scrollPrev, false)
nextButtonNode.addEventListener('click', emblaProduto.scrollNext, false)

const { applyTweenOpacityProduto, removeTweenOpacityProduto } = setupTweenOpacity(emblaProduto)
embla
    .on('init', applyTweenOpacity)
    .on('scroll', applyTweenOpacityProduto)
    .on('reInit', removeTweenOpacityProduto)
    .on('destroy', removeTweenOpacity)