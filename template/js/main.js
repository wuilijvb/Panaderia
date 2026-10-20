(() => {
  const reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;
  const toggle=document.querySelector('.menu-toggle'),nav=document.querySelector('.main-nav');
  toggle?.addEventListener('click',()=>{const open=toggle.getAttribute('aria-expanded')==='true';toggle.setAttribute('aria-expanded',String(!open));nav?.classList.toggle('open',!open);});
  nav?.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{nav.classList.remove('open');toggle?.setAttribute('aria-expanded','false');}));

  const reveals=document.querySelectorAll('.reveal');
  if(reduce) reveals.forEach(el=>el.classList.add('in')); else {const io=new IntersectionObserver(entries=>entries.forEach(entry=>{if(entry.isIntersecting){entry.target.classList.add('in');io.unobserve(entry.target);}}),{threshold:.1});reveals.forEach(el=>io.observe(el));}

  const courseButtons=[...document.querySelectorAll('[data-course]')],items=[...document.querySelectorAll('[data-menu-course]')];
  courseButtons.forEach(btn=>btn.addEventListener('click',()=>{courseButtons.forEach(b=>{const active=b===btn;b.classList.toggle('active',active);b.setAttribute('aria-pressed',String(active));});const course=btn.dataset.course;items.forEach(item=>item.hidden=course!=='all'&&item.dataset.menuCourse!==course);}));

  const dialog=document.querySelector('[data-reserve-dialog]');
  document.querySelectorAll('[data-reserve]').forEach(btn=>btn.addEventListener('click',()=>{dialog?.showModal();document.body.classList.add('dialog-open');}));
  document.querySelector('[data-close]')?.addEventListener('click',()=>dialog?.close());
  dialog?.addEventListener('click',e=>{if(e.target===dialog)dialog.close();});
  dialog?.addEventListener('close',()=>document.body.classList.remove('dialog-open'));

  const date=document.querySelector('input[name="date"]');
  if(date){const now=new Date();const local=new Date(now.getTime()-now.getTimezoneOffset()*60000).toISOString().slice(0,10);date.min=local;}

  const form=document.querySelector('[data-form]');
  form?.addEventListener('submit',async e=>{e.preventDefault();const status=form.querySelector('.form-status'),button=form.querySelector('button[type="submit"]');if(!form.checkValidity()){form.reportValidity();return;}status.textContent='Sending reservation request…';button.disabled=true;try{const response=await fetch(form.action,{method:'POST',body:new FormData(form),headers:{Accept:'application/json'}});const data=await response.json();status.textContent=data.message||(response.ok?'Request received.':'Unable to send.');if(response.ok&&data.ok)form.reset();}catch{status.textContent='Network error. Please try again.';}finally{button.disabled=false;}});
})();
