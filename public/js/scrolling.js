

Draggable.create('.retail-scrollbar-handle', {
    type: "x",
    bounds: ".retail-scrollbar-track",
    throwProps: true,
    onDrag() {
        gsap.to('.portfolio_container1', {x: -this.x, overwrite: true});
    }
});

Draggable.create('.logistics-scrollbar-handle', {
    type: "x",
    bounds: ".logistics-scrollbar-track",
    throwProps: true,
    onDrag() {
        gsap.to('.portfolio_container2', {x: -this.x, overwrite: true});
    }
});

Draggable.create('.horeca-scrollbar-handle', {
    type: "x",
    bounds: ".horeca-scrollbar-track",
    throwProps: true,
    onDrag() {
        gsap.to('.portfolio_container3', {x: -this.x, overwrite: true});
    }
});

Draggable.create('.life-scrollbar-handle', {
    type: "x",
    bounds: ".life-scrollbar-track",
    throwProps: true,
    onDrag() {
        gsap.to('.life_solution_swiper', {x: -this.x, overwrite: true});
    }
});


