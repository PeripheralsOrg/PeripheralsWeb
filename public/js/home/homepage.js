var options = {
    loop: true,
    skipSnaps: true,
    speed: 10,
}
var plugins = [EmblaCarouselAutoplay()] // Plugins

const rootNode = document.querySelector('.box-carrossel')
const viewportNode = rootNode.querySelector('.banner_viewport')

const prevButtonNode = rootNode.querySelector('.banner_prev')
const nextButtonNode = rootNode.querySelector('.banner_next')

const embla = EmblaCarousel(viewportNode, options, plugins)

prevButtonNode.addEventListener('click', embla.scrollPrev, false)
nextButtonNode.addEventListener('click', embla.scrollNext, false)
