 const box = document.querySelector(".box");
 const ani = document.querySelector(".ani");
            
const t1 = new TimelineMax();
            
t1.fromTo(box,0.5,{height:"0%"},{height:"50%",ease:Power2.easeInOut})
t1.fromTo(ani,0.8,{opacity:"0"},{opacity:"1",ease:Power2.easeInOut},"-=0.5");