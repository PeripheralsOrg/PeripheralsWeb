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

prevButtonNode.addEventListener('click', embla.scrollPrev, false)
nextButtonNode.addEventListener('click', embla.scrollNext, false)