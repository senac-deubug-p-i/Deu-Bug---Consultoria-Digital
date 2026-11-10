    <!doctype html>
    <html lang="pt-BR">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Projetos</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="./output.css" />
    
    <style>
    *,::before,::after{box-sizing:border-box}
    body{margin:0;background:#08080A;color:#F2F2F6;font-family:'Plus Jakarta Sans',system-ui,sans-serif;min-height:100vh}
    button,input,select{font:inherit;color:inherit}
    button{background:none;border:0;cursor:pointer;padding:0}
    a{text-decoration:none;color:inherit}
    .ic{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .app{display:flex;min-height:100vh;width:100%}
    /* sidebar */
    .side{width:220px;flex-shrink:0;height:100vh;position:sticky;top:0;background:#0B0B0F;border-right:1px solid #1E1E26;padding:20px 14px;display:flex;flex-direction:column;justify-content:space-between}
    .brand{display:flex;align-items:center;gap:10px;padding:0 6px 18px}
    .logo{width:34px;height:34px;border-radius:10px;background:#7C3AED;display:grid;place-items:center;font-weight:800;font-size:13px;letter-spacing:-.5px;color:#fff}
    .bn{font-weight:800;font-size:14.5px}.br{font-size:8px;font-weight:700;letter-spacing:1.6px;color:#6B6B78;margin-top:1px}
    nav{display:flex;flex-direction:column;gap:3px;padding-top:10px}
    .nav{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:9px;font-size:12.5px;font-weight:500;color:#9A9AA6;transition:background .15s,color .15s}
    .nav .ic{color:#6B6B78;transition:color .15s}
    .nav span{flex:1}
    .nav:hover{background:#15151B;color:#F2F2F6}.nav:hover .ic{color:#C9C9D4}
    .nav.on{background:#7C3AED;color:#fff;font-weight:600}.nav.on .ic{color:#fff}
    .badge{background:#4C1D95;color:#fff;font-size:9px;font-weight:700;padding:2px 6px;border-radius:999px}
    .side-b{display:flex;flex-direction:column;gap:10px}
    .asc{display:flex;justify-content:center;padding:9px 12px;border-radius:10px;background:#15151B;outline:1px solid #26262E;outline-offset:-.5px;font-size:11.5px;font-weight:500;color:#C9C9D4;transition:.15s}
    .asc:hover{background:#1c1c24;outline-color:#7C3AED;color:#fff}
    .user{display:flex;align-items:center;gap:9px;padding:7px 8px;border-radius:10px;background:#15151B;cursor:pointer;transition:background .15s;width:100%;text-align:left}
    .user:hover{background:#1c1c24}
    .av{border-radius:50%;display:grid;place-items:center;color:#fff;font-weight:700;flex-shrink:0}
    .user .av{width:28px;height:28px;font-size:9.5px;background:#6D28D9}
    .ut{flex:1}.un{font-size:11.5px;font-weight:600}.ur{font-size:9px;font-weight:500;color:#6B6B78;margin-top:1px}
    .user .ic{width:13px;height:13px;color:#5f5f68}
    /* main */
    main{flex:1;min-width:0;padding:26px 30px;display:flex;flex-direction:column;gap:18px}
    .head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px}
    h1{margin:0 0 7px;font-size:38px;font-weight:800;letter-spacing:-1.2px;line-height:normal;background:linear-gradient(0deg,#CBAAFF 0%,#9B6BF8 60%,#7C3AED 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;width:fit-content}
    .sub{font-size:12.5px;font-weight:500;color:#7C7C88}
    .btn{display:flex;align-items:center;gap:7px;padding:10px 16px;border-radius:9px;background:#7C3AED;color:#fff;font-size:12px;font-weight:600;white-space:nowrap;transition:background .15s,transform .1s,box-shadow .15s}
    .btn .ic{width:14px;height:14px}
    .btn:hover{background:#8B4CF5;box-shadow:0 6px 20px -6px #7C3AED}.btn:active{transform:scale(.97)}
    .filters{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
    .fl{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
    .search{width:300px;max-width:100%;height:36px;display:flex;align-items:center;gap:8px;padding:0 12px;background:#121217;outline:1px solid #22222A;outline-offset:-.5px;border-radius:10px;transition:.15s}
    .search:focus-within{outline-color:#7C3AED}
    .search .ic{width:13px;height:13px;color:#5f5f68}
    .search input{flex:1;min-width:0;background:none;border:0;outline:0;font-size:11.5px;font-weight:500}
    .search input::placeholder{color:#5F5F68}
    .pill{padding:9px 14px;border-radius:999px;background:#121217;outline:1px solid #22222A;outline-offset:-.5px;font-size:11.5px;font-weight:500;color:#A3A3AE;white-space:nowrap;transition:.15s}
    .pill:hover{background:#1a1a22;color:#fff}
    .pill.on{background:#7C3AED;color:#fff;font-weight:600;outline-color:transparent}
    .dd{position:relative}
    .dd-b{display:flex;align-items:center;justify-content:space-between;gap:24px;padding:9px 14px;border-radius:10px;background:#121217;outline:1px solid #22222A;outline-offset:-.5px;font-size:11.5px;font-weight:500;color:#A3A3AE;transition:.15s}
    .dd-b:hover,.dd.open .dd-b{outline-color:#7C3AED;color:#fff}
    .dd-b .ic{width:13px;height:13px;color:#5f5f68;transition:transform .15s}.dd.open .dd-b .ic{transform:rotate(180deg)}
    .menu{display:none;position:absolute;right:0;top:calc(100% + 6px);min-width:100%;z-index:20;background:#15151B;outline:1px solid #26262E;border-radius:10px;padding:5px;box-shadow:0 14px 34px rgba(0,0,0,.5)}
    .dd.open .menu{display:block}
    .menu button{display:block;width:100%;text-align:left;padding:8px 10px;border-radius:7px;font-size:11.5px;font-weight:500;color:#A3A3AE;white-space:nowrap}
    .menu button:hover{background:#1f1f28;color:#fff}.menu button.on{color:#fff;background:#4C1D95}
    /* kanban */
    .kan{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:12px;align-items:start}
    .col{background:#0E0E12;outline:1px solid #1D1D24;outline-offset:-.5px;border-radius:14px;overflow:hidden;transition:outline-color .15s,background .15s}
    .col.over{outline:1px dashed #7C3AED;background:#13101c}
    .ch{display:flex;justify-content:space-between;align-items:center;padding:13px;background:#15151B}
    .ct{font-size:12.5px;font-weight:700;color:#E8E8EE}
    .cc{background:#232329;color:#A0A0AA;font-size:10px;font-weight:700;padding:2px 7px;border-radius:999px}
    .cards{display:flex;flex-direction:column;gap:10px;padding:10px;min-height:60px}
    .card{display:flex;flex-direction:column;gap:7px;padding:12px;background:#15151A;outline:1px solid #23232B;outline-offset:-.5px;border-radius:12px;cursor:grab;transition:transform .15s,outline-color .15s,background .15s,box-shadow .15s;user-select:none}
    .card:hover{background:#18181f;outline-color:#4C1D95;transform:translateY(-2px);box-shadow:0 10px 24px -10px rgba(124,58,237,.35)}
    .card.drag{opacity:.35;cursor:grabbing}
    .cl{font-size:9.5px;line-height:12px;font-weight:600;color:#75757F}
    .cti{font-size:12.5px;line-height:16px;font-weight:700;color:#EDEDF3}
    .tag{width:fit-content;padding:3px 8px;border-radius:999px;font-size:9px;font-weight:700;white-space:nowrap}
    .t-warn{background:#2F260F;color:#E5C465}.t-red{background:#33131B;color:#F0777C}.t-org{background:#33190D;color:#F0944E}.t-ok{background:#0D2A1C;color:#54D68E}
    .pm{display:flex;justify-content:space-between;align-items:center;padding-top:3px}
    .pc{font-size:10px;font-weight:700;color:#C9C9D2}.pz{font-size:9.5px;font-weight:500;color:#6B6B76}.pz.late{color:#F0777C}
    .trk{height:3px;background:#23232B;border-radius:2px}
    .fill{height:3px;background:#7C3AED;border-radius:2px;transition:width .3s}.fill.g{background:#22C55E}
    .as{display:flex;align-items:center;gap:6px;padding-top:3px;font-size:9.5px;font-weight:500;color:#9A9AA4}
    .as .av{width:18px;height:18px;font-size:7.5px}
    .empty{font-size:10.5px;font-weight:500;color:#5F5F68;text-align:center;padding:18px 0;border:1px dashed #23232B;border-radius:10px}
    /* modal + toast */
    .ov{position:fixed;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(3px);display:none;place-items:center;z-index:50;padding:20px}
    .ov.open{display:grid}
    .modal{width:100%;max-width:440px;background:#0E0E12;outline:1px solid #26262E;border-radius:16px;padding:22px;display:flex;flex-direction:column;gap:14px;box-shadow:0 30px 70px rgba(0,0,0,.6)}
    .modal h2{margin:0;font-size:18px;font-weight:800;letter-spacing:-.4px}
    .f{display:flex;flex-direction:column;gap:6px;font-size:11px;font-weight:600;color:#9A9AA6}
    .f input,.f select{height:38px;padding:0 12px;border-radius:9px;background:#121217;border:0;outline:1px solid #22222A;outline-offset:-.5px;font-size:12px;font-weight:500;color:#F2F2F6;color-scheme:dark;transition:.15s}
    .f input:focus,.f select:focus{outline-color:#7C3AED}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .acts{display:flex;justify-content:flex-end;gap:8px;padding-top:4px}
    .btn.ghost{background:#15151B;outline:1px solid #26262E;color:#C9C9D4}.btn.ghost:hover{background:#1c1c24;box-shadow:none}
    .toast{position:fixed;bottom:24px;left:50%;transform:translate(-50%,20px);background:#15151B;outline:1px solid #4C1D95;color:#F2F2F6;font-size:12px;font-weight:600;padding:10px 16px;border-radius:10px;opacity:0;pointer-events:none;transition:.25s;z-index:60}
    .toast.show{opacity:1;transform:translate(-50%,0)}
    @media(max-width:1180px){.kan{grid-template-columns:repeat(5,260px);overflow-x:auto;padding-bottom:8px}}
    @media(max-width:760px){.side{display:none}main{padding:20px 16px}h1{font-size:30px}}
    </style>
    </head>
<body>
<svg width="0" height="0" style="position:absolute"><defs>
<symbol id="i-dash" viewBox="0 0 24 24"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></symbol>
<symbol id="i-folder" viewBox="0 0 24 24"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></symbol>
<symbol id="i-users" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></symbol>
<symbol id="i-inbox" viewBox="0 0 24 24"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></symbol>
<symbol id="i-card" viewBox="0 0 24 24"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></symbol>
<symbol id="i-ud" viewBox="0 0 24 24"><path d="m7 15 5 5 5-5M7 9l5-5 5 5"/></symbol>
<symbol id="i-plus" viewBox="0 0 24 24"><path d="M5 12h14M12 5v14"/></symbol>
<symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></symbol>
<symbol id="i-down" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></symbol>
</defs></svg>

<div class="app">
  <aside class="side">
    <div>
      <div class="brand"><div class="logo">DI</div><div><div class="bn">Deu Bug!</div><div class="br">ADMIN</div></div></div>
      <nav>
        <a class="nav" href="#"><svg class="ic"><use href="#i-dash"/></svg><span>Visão geral</span></a>
        <a class="nav on" href="#"><svg class="ic"><use href="#i-folder"/></svg><span>Projetos</span></a>
        <a class="nav" href="#"><svg class="ic"><use href="#i-users"/></svg><span>Clientes</span></a>
        <a class="nav" href="#"><svg class="ic"><use href="#i-inbox"/></svg><span>Solicitações</span><i class="badge">5</i></a>
        <a class="nav" href="#"><svg class="ic"><use href="#i-card"/></svg><span>Financeiro</span></a>
      </nav>
    </div>
    <div class="side-b">
      <a class="asc" href="#">Ver como cliente</a>
      <button class="user"><div class="av">RL</div><div class="ut"><div class="un">Rafael Lima</div><div class="ur">Gerente de projetos</div></div><svg class="ic"><use href="#i-ud"/></svg></button>
    </div>
  </aside>

  <main>
    <div class="head">
      <div><h1>Projetos</h1><div class="sub">Arraste os cards entre as colunas para mudar a etapa.</div></div>
      <button class="btn" id="novo"><svg class="ic"><use href="#i-plus"/></svg>Novo projeto</button>
    </div>
    <div class="filters">
      <div class="fl">
        <label class="search"><svg class="ic"><use href="#i-search"/></svg><input id="q" placeholder="Buscar projeto ou cliente" autocomplete="off" /></label>
        <button class="pill on" data-f="todos">Todos</button>
        <button class="pill" data-f="meus">Meus projetos</button>
        <button class="pill" data-f="pend">Com pendência</button>
        <button class="pill" data-f="atr">Atrasados</button>
      </div>
      <div class="dd" id="dd">
        <button class="dd-b" id="ddb"><span id="ddl">Todos os responsáveis</span><svg class="ic"><use href="#i-down"/></svg></button>
        <div class="menu" id="menu"></div>
      </div>
    </div>
    <div class="kan" id="kan"></div>
  </main>
</div>

<div class="ov" id="ov">
  <div class="modal" role="dialog" aria-modal="true">
    <h2>Novo projeto</h2>
    <label class="f">Título<input id="m-t" placeholder="Ex.: Landing page" /></label>
    <label class="f">Cliente<input id="m-c" placeholder="Ex.: Padaria Doce Trigo" /></label>
    <div class="row">
      <label class="f">Responsável<select id="m-o"></select></label>
      <label class="f">Prazo<input id="m-p" type="date" /></label>
    </div>
    <label class="f">Etapa<select id="m-s"></select></label>
    <div class="acts"><button class="btn ghost" id="m-x">Cancelar</button><button class="btn" id="m-ok">Criar projeto</button></div>
  </div>
</div>
<div class="toast" id="toast"></div>

<script>
const STAGES=['Briefing','Design','Desenvolvimento','Revisão','Publicado'];
const OWN={RL:['Rafael Lima','#5B21B6'],DN:['Diego Nunes','#4C1D95'],AC:['Ana Costa','#4C1D95'],LA:['Lucas Almeida','#6D28D9'],BT:['Bruna Teixeira','#0F766E']};
const ME='RL', MES=['jan','fev','mar','abr','mai','jun','jul','ago','set','out','nov','dez'];
const YEAR=new Date().getFullYear();
let uid=0;
const P=(s,c,t,pct,d,m,o,tag,tt)=>({id:++uid,s,c,t,pct,d,m,o,tag:tag||null,tt:tt||null});
let data=[
 P(0,'Studio Aurora Pilates','Landing Aurora Pilates',15,5,10,'RL','Fotos pendentes','warn'),
 P(0,'Móveis Pereira','Catálogo online',8,28,10,'RL'),
 P(0,'Escola Pequeno Mundo','Site institucional',5,10,11,'DN'),
 P(1,'Clínica Vida Plena','Site Clínica Vida Plena',35,21,9,'AC','Vence em 2 dias','red'),
 P(1,'Padaria Doce Trigo','Promoção de Natal',22,20,11,'AC'),
 P(1,'Café Girassol','Identidade para o cardápio digital',40,14,10,'AC'),
 P(2,'Padaria Doce Trigo','Loja online Doce Trigo',62,14,10,'LA'),
 P(2,'Café Girassol','Loja Café Girassol',48,12,10,'LA','Fatura em atraso','org'),
 P(2,'Studio Aurora Pilates','Agendamento de aulas',70,2,10,'BT'),
 P(3,'Padaria Doce Trigo','Site Doce Trigo',88,30,9,'AC','Aguardando cliente','warn'),
 P(3,'Clínica Vida Plena','Área de exames online',92,26,9,'BT'),
 P(3,'Móveis Pereira','Site institucional',95,24,9,'LA'),
 P(4,'Mecânica Irmãos Souza','Site Mecânica Irmãos Souza',100,18,9,'BT','No ar desde 18 out','ok'),
 P(4,'Escola Pequeno Mundo','Página de matrículas',100,2,9,'LA','No ar desde 02 out','ok'),
];
const st={q:'',f:'todos',o:'all'};
const $=s=>document.querySelector(s), pad=n=>String(n).padStart(2,'0');
const esc=s=>s.replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
const date=p=>new Date(YEAR,p.m,p.d);
const late=p=>p.s<4&&date(p)<new Date(new Date().setHours(0,0,0,0));
const pend=p=>p.tag&&p.tt!=='ok';
function visible(p){
  const q=st.q.trim().toLowerCase();
  if(q&&!(p.t+' '+p.c).toLowerCase().includes(q))return false;
  if(st.o!=='all'&&p.o!==st.o)return false;
  if(st.f==='meus'&&p.o!==ME)return false;
  if(st.f==='pend'&&!pend(p))return false;
  if(st.f==='atr'&&!late(p))return false;
  return true;
}
function cardHTML(p){
  const [name,col]=OWN[p.o], pub=p.s===4;
  return `<div class="card" draggable="true" data-id="${p.id}">
    <div class="cl">${esc(p.c)}</div><div class="cti">${esc(p.t)}</div>
    ${p.tag?`<div class="tag t-${p.tt}">${esc(p.tag)}</div>`:''}
    ${pub?'':`<div class="pm"><span class="pc">${p.pct}%</span><span class="pz ${late(p)?'late':''}">Prazo ${pad(p.d)} ${MES[p.m]}</span></div>`}
    <div class="trk"><div class="fill ${pub?'g':''}" style="width:${p.pct}%"></div></div>
    <div class="as"><div class="av" style="background:${col}">${p.o}</div>${name}</div></div>`;
}
function render(){
  $('#kan').innerHTML=STAGES.map((n,i)=>{
    const l=data.filter(p=>p.s===i&&visible(p));
    return `<section class="col" data-s="${i}"><div class="ch"><span class="ct">${n}</span><span class="cc">${l.length}</span></div>
    <div class="cards">${l.map(cardHTML).join('')||'<div class="empty">Nenhum projeto</div>'}</div></section>`;
  }).join('');
}
/* drag & drop (delegação) */
let dragId=null;
const kan=$('#kan');
kan.addEventListener('dragstart',e=>{const c=e.target.closest('.card');if(!c)return;dragId=+c.dataset.id;c.classList.add('drag');e.dataTransfer.effectAllowed='move';e.dataTransfer.setData('text/plain',dragId)});
kan.addEventListener('dragend',()=>{dragId=null;document.querySelectorAll('.drag,.over').forEach(x=>x.classList.remove('drag','over'))});
kan.addEventListener('dragover',e=>{const c=e.target.closest('.col');if(!c||dragId==null)return;e.preventDefault();document.querySelectorAll('.over').forEach(x=>x!==c&&x.classList.remove('over'));c.classList.add('over')});
kan.addEventListener('drop',e=>{
  const c=e.target.closest('.col');if(!c||dragId==null)return;e.preventDefault();
  const p=data.find(x=>x.id===dragId), to=+c.dataset.s;
  if(p.s!==to){
    const from=p.s;p.s=to;
    if(to===4){const n=new Date();p.pct=100;p.tag='No ar desde '+pad(n.getDate())+' '+MES[n.getMonth()];p.tt='ok'}
    else if(from===4){p.pct=Math.min(p.pct,95);p.tag=null;p.tt=null}
    data=data.filter(x=>x!==p);data.push(p);
    toast(`“${p.t}” movido para ${STAGES[to]}`);
  }
  render();
});
/* filtros */
$('#q').addEventListener('input',e=>{st.q=e.target.value;render()});
document.querySelectorAll('.pill').forEach(b=>b.addEventListener('click',()=>{
  st.f=b.dataset.f;document.querySelectorAll('.pill').forEach(x=>x.classList.toggle('on',x===b));render();
}));
/* responsáveis */
const owners=[['all','Todos os responsáveis'],...Object.entries(OWN).map(([k,v])=>[k,v[0]])];
$('#menu').innerHTML=owners.map(([k,n])=>`<button data-o="${k}" class="${k==='all'?'on':''}">${n}</button>`).join('');
$('#ddb').addEventListener('click',e=>{e.stopPropagation();$('#dd').classList.toggle('open')});
$('#menu').addEventListener('click',e=>{
  const b=e.target.closest('button');if(!b)return;
  st.o=b.dataset.o;$('#ddl').textContent=b.textContent;
  document.querySelectorAll('#menu button').forEach(x=>x.classList.toggle('on',x===b));
  $('#dd').classList.remove('open');render();
});
document.addEventListener('click',()=>$('#dd').classList.remove('open'));
/* modal */
$('#m-o').innerHTML=Object.entries(OWN).map(([k,v])=>`<option value="${k}">${v[0]}</option>`).join('');
$('#m-s').innerHTML=STAGES.slice(0,4).map((n,i)=>`<option value="${i}">${n}</option>`).join('');
const ov=$('#ov'), close=()=>ov.classList.remove('open');
$('#novo').addEventListener('click',()=>{
  ['m-t','m-c'].forEach(i=>$('#'+i).value='');
  const d=new Date();d.setDate(d.getDate()+14);
  $('#m-p').value=`${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
  $('#m-o').value=ME;$('#m-s').value=0;ov.classList.add('open');$('#m-t').focus();
});
$('#m-x').addEventListener('click',close);
ov.addEventListener('mousedown',e=>{if(e.target===ov)close()});
document.addEventListener('keydown',e=>{if(e.key==='Escape')close();if(e.key==='Enter'&&ov.classList.contains('open')&&e.target.tagName==='INPUT')$('#m-ok').click()});
$('#m-ok').addEventListener('click',()=>{
  const t=$('#m-t').value.trim(),c=$('#m-c').value.trim();
  if(!t||!c){toast('Preencha título e cliente');(!t?$('#m-t'):$('#m-c')).focus();return}
  const [y,m,d]=($('#m-p').value||'').split('-').map(Number);
  const dt=d?{d,m:m-1}:{d:new Date().getDate(),m:new Date().getMonth()};
  data.push(P(+$('#m-s').value,c,t,0,dt.d,dt.m,$('#m-o').value));
  close();render();toast('Projeto criado');
});
/* toast */
let tt;function toast(m){const t=$('#toast');t.textContent=m;t.classList.add('show');clearTimeout(tt);tt=setTimeout(()=>t.classList.remove('show'),2200)}
render();
</script>
</body>
</html>