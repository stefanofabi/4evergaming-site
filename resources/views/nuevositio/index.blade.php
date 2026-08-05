<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>4evergaming — Servidores de Juegos, VPS y Web Hosting en Argentina</title>

<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
  :root{
    --bg:#0a0a0c;
    --bg-panel:#131316;
    --bg-panel-2:#1b1b1f;
    --red:#e0102a;
    --red-bright:#ff2f47;
    --red-dark:#5c0e1c;
    --red-dark-2:#3a0a13;
    --line:rgba(255,255,255,0.08);
    --line-strong:rgba(255,255,255,0.14);
    --text:#eceae6;
    --text-dim:#a3a1a0;
    --text-dimmer:#6f6d6c;
    --green:#39d97a;
    --radius:2px;
    --wrap:1180px;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{
    background:var(--bg);
    color:var(--text);
    font-family:'Inter',sans-serif;
    line-height:1.55;
    -webkit-font-smoothing:antialiased;
    overflow-x:hidden;
  }
  h1,h2,h3,h4{
    font-family:'Rajdhani',sans-serif;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:0.02em;
    line-height:1.05;
  }
  .mono{font-family:'JetBrains Mono',monospace;}
  a{color:inherit; text-decoration:none;}
  ul{list-style:none;}
  img{max-width:100%; display:block;}
  .wrap{max-width:var(--wrap); margin:0 auto; padding:0 24px;}
  .eyebrow{
    font-family:'JetBrains Mono',monospace;
    font-size:12px;
    letter-spacing:0.18em;
    text-transform:uppercase;
    color:var(--red-bright);
    display:flex; align-items:center; gap:10px;
    margin-bottom:14px;
  }
  .eyebrow::before{content:''; width:18px; height:1px; background:var(--red-bright);}
  .section{padding:96px 0;}
  .section-head{max-width:640px; margin-bottom:52px;}
  .section-head h2{font-size:clamp(30px,4vw,44px); margin-bottom:14px;}
  .section-head p{color:var(--text-dim); font-size:16px;}
  .btn{
    display:inline-flex; align-items:center; gap:8px;
    font-family:'JetBrains Mono',monospace;
    font-size:13px; font-weight:500; letter-spacing:0.03em;
    padding:13px 22px; border-radius:var(--radius);
    border:1px solid transparent; cursor:pointer;
    transition:all .15s ease;
    text-transform:uppercase;
  }
  .btn-primary{background:var(--red); color:#fff;}
  .btn-primary:hover{background:var(--red-bright); box-shadow:0 0 0 3px rgba(224,16,42,0.18);}
  .btn-ghost{border-color:var(--line-strong); color:var(--text);}
  .btn-ghost:hover{border-color:var(--red); color:#fff;}
  .btn-sm{padding:9px 16px; font-size:12px;}
  ::selection{background:var(--red); color:#fff;}

  /* ---------- TOPBAR ---------- */
  .topbar{
    background:#000; border-bottom:1px solid var(--line);
    font-family:'JetBrains Mono',monospace; font-size:12px; color:var(--text-dimmer);
  }
  .topbar .wrap{display:flex; justify-content:space-between; align-items:center; height:38px;}
  .topbar-links{display:flex; align-items:center; gap:18px;}
  .topbar-links a{display:flex; align-items:center; gap:6px;}
  .topbar-links a:hover{color:var(--red-bright);}
  .icon-wsp-top{width:14px; height:14px; color:var(--green);}
  .topbar-social{display:flex; align-items:center; gap:16px;}
  .topbar-social a{color:var(--text-dimmer); display:flex; align-items:center;}
  .topbar-social a:hover{color:var(--red-bright);}
  .icon-sm{width:15px; height:15px;}
  @media (max-width:760px){ .topbar-links span.sep{display:none;} .topbar .wrap{font-size:10.5px;} }

  /* ---------- HEADER / NAV ---------- */
  header.site{
    position:sticky; top:0; z-index:100;
    background:rgba(10,10,12,0.92); backdrop-filter:blur(10px);
    border-bottom:1px solid var(--line);
  }
  .nav{display:flex; align-items:center; justify-content:space-between; height:72px;}
  .logo{display:flex; align-items:center; gap:10px; font-family:'Rajdhani'; font-weight:700; font-size:22px; letter-spacing:0.02em; color:#fff;}
  .logo .dot{width:9px; height:9px; background:var(--red); border-radius:1px; box-shadow:0 0 10px var(--red);}
  nav.menu{display:flex; align-items:center; gap:2px;}
  .menu-item{position:relative;}
  .menu-item > .menu-trigger{
    display:flex; align-items:center; gap:5px;
    padding:12px 14px; font-size:13.5px; font-weight:600; color:var(--text-dim);
    cursor:pointer; transition:color .15s;
  }
  .menu-item > .menu-trigger:hover, .menu-item:hover > .menu-trigger{color:var(--text);}
  .menu-item > .menu-trigger .caret{font-size:9px; opacity:.6; transform:translateY(1px);}
  .dropdown{
    position:absolute; top:100%; left:0; min-width:230px;
    background:var(--bg-panel); border:1px solid var(--line-strong);
    border-top:2px solid var(--red);
    opacity:0; visibility:hidden; transform:translateY(6px);
    transition:all .15s ease;
    padding:6px 0;
  }
  .menu-item:hover .dropdown{opacity:1; visibility:visible; transform:translateY(0);}
  .dropdown a{display:block; padding:10px 16px; font-size:13.5px; color:var(--text-dim);}
  .dropdown a:hover{background:var(--red-dark-2); color:#fff;}
  .nav-actions{display:flex; align-items:center; gap:10px;}
  .burger{display:none; flex-direction:column; gap:4px; cursor:pointer; padding:6px;}
  .burger span{width:22px; height:2px; background:var(--text);}
  @media (max-width:980px){
    nav.menu{display:none;}
    .burger{display:flex;}
  }

@media (max-width:640px){
    .client-area{
        display:none;
    }
}

  /* ---------- HERO ---------- */
  .hero{
    position:relative;
    padding:88px 0 100px;
    background:
      radial-gradient(ellipse 60% 50% at 15% 0%, rgba(224,16,42,0.16), transparent 60%),
      radial-gradient(ellipse 50% 60% at 100% 10%, rgba(224,16,42,0.10), transparent 60%),
      var(--bg);
    border-bottom:1px solid var(--line);
    overflow:hidden;
  }
  .hero::after{
    content:''; position:absolute; inset:0;
    background-image:linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
    background-size:38px 38px;
    -webkit-mask-image:radial-gradient(ellipse 70% 70% at 50% 20%, black, transparent 75%);
            mask-image:radial-gradient(ellipse 70% 70% at 50% 20%, black, transparent 75%);
    pointer-events:none;
  }
  .hero-grid{display:grid; grid-template-columns:1.05fr 0.95fr; gap:56px; align-items:center; position:relative;}
  @media (max-width:980px){ .hero-grid{grid-template-columns:1fr;} }
  .hero-tag{
    display:inline-flex; align-items:center; gap:8px;
    font-family:'JetBrains Mono'; font-size:11.5px; letter-spacing:0.1em; text-transform:uppercase;
    color:var(--green); border:1px solid rgba(57,217,122,0.3); background:rgba(57,217,122,0.06);
    padding:6px 12px; border-radius:20px; margin-bottom:22px;
    transition:border-color .15s, background .15s;
  }
  a.hero-tag:hover{border-color:rgba(57,217,122,0.55); background:rgba(57,217,122,0.12);}
  .hero-tag .ping{width:7px; height:7px; border-radius:50%; background:var(--green); box-shadow:0 0 8px var(--green); animation:pulse 1.6s infinite;}
  @keyframes pulse{0%,100%{opacity:1;} 50%{opacity:.35;}}
  .hero h1{font-size:clamp(38px,5.4vw,64px); margin-bottom:20px;}
  .hero h1 span{color:var(--red-bright);}
  .hero p.lead{color:var(--text-dim); font-size:17px; max-width:480px; margin-bottom:32px;}
  .hero-cta{display:flex; gap:14px; flex-wrap:wrap; margin-bottom:40px;}
  .hero-stats{display:flex; gap:32px; flex-wrap:wrap;}
  .hero-stats div b{display:block; font-family:'Rajdhani'; font-size:26px; font-weight:700; color:#fff;}
  .hero-stats div span{font-family:'JetBrains Mono'; font-size:11px; color:var(--text-dimmer); text-transform:uppercase; letter-spacing:0.04em;}

  /* terminal */
  .terminal{
    background:#000; border:1px solid var(--line-strong); border-radius:6px;
    box-shadow:0 30px 60px -20px rgba(224,16,42,0.25), 0 0 0 1px rgba(255,255,255,0.02);
    overflow:hidden;
  }
  .terminal-bar{
    display:flex; align-items:center; gap:8px; padding:10px 14px;
    background:#0f0f11; border-bottom:1px solid var(--line);
  }
  .terminal-bar span{width:10px; height:10px; border-radius:50%; background:#333;}
  .terminal-bar span:nth-child(1){background:#4d4d4d;}
  .terminal-bar .title{
    margin-left:8px; font-family:'JetBrains Mono'; font-size:11.5px; color:var(--text-dimmer);
  }
  .terminal-body{
    padding:22px 20px 26px; font-family:'JetBrains Mono'; font-size:13.5px; min-height:230px;
    color:#d6d6d6;
  }
  .terminal-body .l{margin-bottom:8px; white-space:pre-wrap;}
  .terminal-body .prompt{color:var(--green);}
  .terminal-body .cmd{color:#fff;}
  .terminal-body .ok{color:var(--green);}
  .terminal-body .warn{color:var(--red-bright);}
  .terminal-body .dim{color:var(--text-dimmer);}
  .caret{display:inline-block; width:7px; height:15px; background:var(--red-bright); vertical-align:middle; animation:blink 1s steps(1) infinite;}
  @keyframes blink{50%{opacity:0;}}

  /* ---------- FEATURE STRIP (ex-carousel) ---------- */
  .feature-strip{background:var(--bg-panel); border-bottom:1px solid var(--line);}
  .feature-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:0;}
  @media (max-width:900px){ .feature-grid{grid-template-columns:repeat(2,1fr);} }
  @media (max-width:560px){ .feature-grid{grid-template-columns:1fr;} }
  .feature-card{
    padding:34px 28px; border-right:1px solid var(--line);
    transition:background .15s;
  }
  .feature-grid .feature-card:last-child{border-right:none;}
  .feature-card:hover{background:var(--bg-panel-2);}
  .feature-card .num{font-family:'JetBrains Mono'; font-size:11px; color:var(--red-bright); letter-spacing:0.1em;}
  .feature-card h3{font-size:19px; margin:12px 0 8px;}
  .feature-card p{font-size:14px; color:var(--text-dim);}

  /* ---------- KILLFEED TICKER (signature) ---------- */
  .killfeed-section{
    background:var(--bg); border-bottom:1px solid var(--line);
    padding:0;
  }
  .killfeed-head{
    display:flex; align-items:center; justify-content:space-between; gap:20px;
    padding:16px 24px; max-width:var(--wrap); margin:0 auto;
    border-bottom:1px dashed var(--line);
  }
  .killfeed-head .eyebrow{margin-bottom:0;}
  .killfeed-head .count{font-family:'JetBrains Mono'; font-size:12px; color:var(--text-dimmer);}
  .killfeed-viewport{overflow:hidden; position:relative; padding:14px 0;}
  .killfeed-viewport::before, .killfeed-viewport::after{
    content:''; position:absolute; top:0; bottom:0; width:80px; z-index:2;
  }
  .killfeed-viewport::before{left:0; background:linear-gradient(90deg,var(--bg),transparent);}
  .killfeed-viewport::after{right:0; background:linear-gradient(270deg,var(--bg),transparent);}
  .killfeed-track{display:flex; gap:14px; width:max-content; animation:scrollfeed 100s linear infinite;}
  .killfeed-viewport:hover .killfeed-track{animation-play-state:paused;}
  @keyframes scrollfeed{ from{transform:translateX(0);} to{transform:translateX(-50%);} }
  .kf-item{
    display:flex; align-items:center; gap:10px; white-space:nowrap;
    background:var(--bg-panel); border:1px solid var(--line); border-left:2px solid var(--red);
    padding:10px 16px; border-radius:2px; font-size:13px;
  }
  .kf-item b{color:#fff; font-weight:600;}
  .kf-item .icon{color:var(--red-bright); font-family:'JetBrains Mono'; font-size:12px;}
  .kf-item .item{color:var(--text-dim);}
  .kf-item .item em{color:var(--green); font-style:normal;}
  .kf-item .time{color:var(--text-dimmer); font-family:'JetBrains Mono'; font-size:11px;}

  /* ---------- GAME TRACKER ---------- */
  .tracker-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:16px;}
  @media (max-width:900px){ .tracker-grid{grid-template-columns:repeat(2,1fr);} }
  .tracker-card{
    background:var(--bg-panel); border:1px solid var(--line);
    padding:24px; text-align:center; transition:all .15s;
  }
  .tracker-card:hover{border-color:var(--red); transform:translateY(-3px);}
  .tracker-card .glyph{
    width:64px; height:64px; margin:0 auto 14px; border-radius:10px;
    display:flex; align-items:center; justify-content:center;
    font-family:'JetBrains Mono'; font-weight:700; color:var(--red-bright); font-size:14px;
    overflow:hidden;
  }
  .tracker-card .glyph img{width:100%; height:100%; object-fit:contain; padding:8px;}
  .tracker-card .glyph .fallback{font-size:13px; letter-spacing:0.03em;}
  .tracker-card h4{font-size:16px; margin-bottom:4px;}
  .tracker-card span{font-size:12px; color:var(--text-dimmer); font-family:'JetBrains Mono';}
  .tracker-more{text-align:center; margin-top:22px;}

  /* ---------- GAMES GRID ---------- */
  .games-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:18px;}
  @media (max-width:900px){ .games-grid{grid-template-columns:repeat(2,1fr);} }
  @media (max-width:560px){ .games-grid{grid-template-columns:1fr;} }
  .game-card{
    position:relative; background:var(--bg-panel); border:1px solid var(--line);
    padding:26px; overflow:hidden; transition:border-color .15s, transform .15s;
  }
  .game-card:hover{border-color:var(--red); transform:translateY(-3px);}
  .game-card .tag{
    position:absolute; top:0; right:0; font-family:'JetBrains Mono'; font-size:10px;
    background:var(--red); color:#fff; padding:4px 10px; letter-spacing:0.06em;
  }
  .game-card h3{font-size:20px; margin:6px 0 8px;}
  .game-card p{font-size:13.5px; color:var(--text-dim); margin-bottom:16px; min-height:40px;}
  .game-card .price{font-family:'JetBrains Mono'; font-size:12px; color:var(--text-dimmer);}
  .game-card .price b{color:var(--green); font-size:15px;}
  .game-card a.arrow{
    display:inline-flex; align-items:center; gap:6px; margin-top:14px;
    font-family:'JetBrains Mono'; font-size:12.5px; color:var(--red-bright); font-weight:600;
  }
  .game-card a.arrow:hover{gap:10px;}
  .more-games{
    margin-top:22px; display:flex; flex-wrap:wrap; gap:10px;
  }
  .more-games a{
    font-family:'JetBrains Mono'; font-size:12.5px; color:var(--text-dim);
    border:1px solid var(--line-strong); padding:8px 14px; border-radius:20px;
    transition:all .15s;
  }
  .more-games a:hover{border-color:var(--red); color:#fff;}

  /* ---------- PRICING (VPS & WEB) ---------- */
  .plans-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:16px;}
  @media (max-width:980px){ .plans-grid{grid-template-columns:repeat(2,1fr);} }
  @media (max-width:560px){ .plans-grid{grid-template-columns:1fr;} }
  .plan-card{
    background:var(--bg-panel); border:1px solid var(--line); padding:26px 22px;
    display:flex; flex-direction:column; transition:all .15s;
  }
  .plan-card.featured{border-color:var(--red); background:linear-gradient(180deg, var(--red-dark-2), var(--bg-panel) 40%); position:relative;}
  .plan-card.featured::before{
    content:'MÁS ELEGIDO'; position:absolute; top:-1px; left:-1px; right:-1px;
    background:var(--red); color:#fff; font-family:'JetBrains Mono'; font-size:10px; text-align:center;
    padding:5px; letter-spacing:0.08em;
  }
  .plan-card.featured .plan-name{margin-top:14px;}
  .plan-name{font-size:19px; margin-bottom:4px;}
  .plan-specs{list-style:none; margin:16px 0; flex-grow:1;}
  .plan-specs li{
    font-size:13px; color:var(--text-dim); padding:7px 0; border-bottom:1px solid var(--line);
    display:flex; justify-content:space-between; gap:8px;
  }
  .plan-specs li:last-child{border-bottom:none;}
  .plan-specs li b{color:#fff; font-family:'JetBrains Mono'; font-weight:500;}
  .plan-price{margin:14px 0 18px;}
  .plan-price .old{font-family:'JetBrains Mono'; font-size:13px; color:var(--text-dimmer); text-decoration:line-through;}
  .plan-price .now{font-family:'Rajdhani'; font-size:32px; font-weight:700; color:#fff;}
  .plan-price .now span{font-family:'JetBrains Mono'; font-size:12px; color:var(--text-dimmer); font-weight:400; text-transform:none;}
  .plan-actions{display:flex; flex-direction:column; gap:8px;}

  .check-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:10px 28px; margin-top:44px;}
  @media (max-width:700px){ .check-grid{grid-template-columns:1fr 1fr;} }
  .check-grid li{font-size:14px; color:var(--text-dim); display:flex; gap:10px; align-items:center;}
  .check-grid li::before{content:'✓'; color:var(--green); font-family:'JetBrains Mono'; font-weight:700;}

  .custom-plan-cta{
    margin-top:30px; display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;
    padding:26px 28px; background:var(--bg-panel); border:1px dashed var(--line-strong);
  }
  .custom-plan-cta p{color:var(--text-dim); font-size:15px;}
  .custom-plan-cta strong{display:block; color:#fff; font-family:'Rajdhani'; font-size:18px; text-transform:uppercase;}

  /* ---------- WHY US ---------- */
  .why-grid{display:grid; grid-template-columns:repeat(3,1fr); gap:20px;}
  @media (max-width:900px){ .why-grid{grid-template-columns:1fr;} }
  .why-card{background:var(--bg-panel); border:1px solid var(--line); padding:32px 28px; transition:border-color .15s, transform .15s;}
  .why-card:hover{border-color:var(--red); transform:translateY(-3px);}
  .why-card .mark{
    width:52px; height:52px; border:1px solid var(--red-dark); background:var(--red-dark-2); color:var(--red-bright);
    display:flex; align-items:center; justify-content:center;
    margin-bottom:20px; border-radius:10px;
  }
  .why-card .mark svg{width:26px; height:26px; stroke:var(--red-bright); fill:none; stroke-width:1.6; stroke-linecap:round; stroke-linejoin:round;}
  .why-card h3{font-size:19px; margin-bottom:10px;}
  .why-card p{font-size:14px; color:var(--text-dim);}

  /* ---------- HISTORIA / STATS TIMELINE ---------- */
  .history{background:var(--bg-panel); border-top:1px solid var(--line); border-bottom:1px solid var(--line);}
  .history-grid{display:grid; grid-template-columns:1fr 1fr 1fr; gap:0;}
  @media (max-width:900px){ .history-grid{grid-template-columns:1fr;} }
  .history-item{padding:44px 34px; border-right:1px solid var(--line);}
  .history-grid .history-item:last-child{border-right:none;}
  @media (max-width:900px){ .history-item{border-right:none; border-bottom:1px solid var(--line);} }
  .history-item .eyebrow{color:var(--text-dimmer); font-size:11px;}
  .history-item .eyebrow::before{background:var(--text-dimmer);}
  .history-item h3{font-size:clamp(24px,2.6vw,32px); color:var(--red-bright); margin-bottom:14px;}
  .history-item p{font-size:14px; color:var(--text-dim);}

  /* ---------- COMMUNITIES ---------- */
  .comm-grid{display:grid; grid-template-columns:repeat(5,1fr); gap:14px;}
  @media (max-width:980px){ .comm-grid{grid-template-columns:repeat(4,1fr);} }
  @media (max-width:640px){ .comm-grid{grid-template-columns:repeat(2,1fr);} }
  .comm-card{
    background:var(--bg-panel); border:1px solid var(--line); border-radius:2px;
    padding:18px 12px; text-align:center; display:block;
    transition:border-color .15s, transform .15s;
  }
  a.comm-card:hover{border-color:var(--red); transform:translateY(-3px);}
  .comm-card .logo-slot{
    height:48px; margin:0 auto 12px; display:flex; align-items:center; justify-content:center;
    border:1px dashed var(--line-strong); border-radius:6px; background:rgba(255,255,255,0.02);
  }
  .comm-card .logo-slot img{max-height:100%; max-width:100%;}
  .comm-card span{font-family:'JetBrains Mono'; font-size:12px; color:var(--text-dim); line-height:1.3;}

  .comm-card .community-name{
    font-family:'JetBrains Mono';
    font-size:16px;
    font-weight:600;
    color:var(--text);
    line-height:1.4;
    display:block;      /* importante para que el margen funcione correctamente */
    margin-top:12px;    /* separa el nombre del logo */
  }

  /* ---------- RESOURCES ---------- */
  .resources-grid{display:grid; grid-template-columns:repeat(2,1fr); gap:20px; max-width:820px;}
  @media (max-width:700px){ .resources-grid{grid-template-columns:1fr;} }
  .resource-card{background:var(--bg-panel); border:1px solid var(--line); padding:30px;}
  .resource-card h3{font-size:18px; margin-bottom:10px;}
  .resource-card p{font-size:14px; color:var(--text-dim); margin-bottom:16px;}
  .resource-card ul{margin-bottom:20px;}
  .resource-card ul li{font-size:13px; color:var(--text-dim); padding:4px 0; display:flex; gap:8px;}
  .resource-card ul li::before{content:'—'; color:var(--red-bright);}
  .resource-card .links{display:flex; gap:10px; flex-wrap:wrap;}

/* ---------- PAYMENT ---------- */

.pay-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
}

@media (max-width:900px){
    .pay-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

.pay-card{
    background:var(--bg-panel);
    border:1px solid var(--line);
    border-radius:8px;
    padding:24px 20px;
    text-align:center;
    display:block;
    transition:border-color .2s, transform .2s, box-shadow .2s;
}

a.pay-card:hover{
    border-color:var(--red);
    transform:translateY(-4px);
    box-shadow:0 10px 24px rgba(0,0,0,.30);
}

.pay-card .logo-slot{
    height:48px;
    margin:0 auto 16px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.pay-card .logo-slot i{
    font-size:42px;
    color:var(--red-bright);
    transition:transform .2s, color .2s;
}

a.pay-card:hover .logo-slot i{
    transform:scale(1.1);
    color:var(--red);
}

.pay-card .logo-slot img{
    max-width:80px;
    max-height:40px;
    object-fit:contain;
}

.pay-card span.label{
    display:block;
    margin-top:6px;
    font-size:16px;
    font-weight:400;
    color:var(--text);
    line-height:1.35;
}

.pay-card .disc{
    display:block;
    margin-top:10px;
    font-family:'JetBrains Mono', monospace;
    font-size:13px;
    font-weight:400;
    color:var(--green);
    letter-spacing:.3px;
}

  /* ---------- CTA BAND ---------- */
  .cta-band{
    background:linear-gradient(135deg, var(--red-dark-2), #000 70%);
    border-top:1px solid var(--red-dark); border-bottom:1px solid var(--line);
    text-align:center; padding:80px 24px;
  }
  .cta-band h2{font-size:clamp(28px,4vw,42px); margin-bottom:16px;}
  .cta-band p{color:var(--text-dim); margin-bottom:30px; max-width:520px; margin-left:auto; margin-right:auto;}
  .cta-band .hero-cta{justify-content:center;}

  /* ---------- FOOTER ---------- */
  footer{background:#000; padding:64px 0 28px; border-top:1px solid var(--line);}
  .footer-grid{display:grid; grid-template-columns:1.4fr 1fr 1fr 1fr; gap:40px; margin-bottom:48px;}
  @media (max-width:900px){ .footer-grid{grid-template-columns:1fr 1fr;} }
  @media (max-width:560px){ .footer-grid{grid-template-columns:1fr;} }
  .footer-grid h4{font-size:13px; letter-spacing:0.08em; color:var(--text-dimmer); margin-bottom:16px; font-family:'JetBrains Mono'; text-transform:uppercase; font-weight:500;}
  .footer-grid ul li{margin-bottom:10px;}
  .footer-grid ul li a{font-size:14px; color:var(--text-dim);}
  .footer-grid ul li a:hover{color:#fff;}
  .footer-brand p{color:var(--text-dim); font-size:14px; max-width:280px; margin:14px 0 20px;}
  .footer-social{display:flex; gap:12px;}
  .footer-social a{
    width:34px; height:34px; border:1px solid var(--line-strong); border-radius:50%;
    display:flex; align-items:center; justify-content:center; font-size:12px; color:var(--text-dim);
  }
  .footer-social a:hover{border-color:var(--red); color:#fff;}

  /* ---------- FLOATING WHATSAPP ---------- */
  .wsp-float{
    position:fixed; right:22px; bottom:22px; z-index:200;
    width:54px; height:54px; border-radius:50%;
    background:#25D366; color:#fff;
    display:flex; align-items:center; justify-content:center;
    box-shadow:0 8px 24px rgba(0,0,0,0.4);
    transition:transform .15s ease;
  }
  .wsp-float:hover{transform:scale(1.08);}
  .wsp-float svg{width:26px; height:26px;}
  .footer-bottom{
    //display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;
    padding-top:24px; border-top:1px solid var(--line);
    font-family:'JetBrains Mono'; font-size:12px; color:var(--text-dimmer);
  }

  /* reveal on scroll */
  .reveal{opacity:0; transform:translateY(16px); transition:opacity .5s ease, transform .5s ease;}
  .reveal.in{opacity:1; transform:translateY(0);}

  @media (prefers-reduced-motion: reduce){
    html{scroll-behavior:auto;}
    .killfeed-track{animation:none;}
    .hero-tag .ping{animation:none;}
    .caret{animation:none;}
    .reveal{opacity:1; transform:none; transition:none;}
  }
</style>
</head>



<body>
<svg width="0" height="0" style="position:absolute; overflow:hidden;" aria-hidden="true">
  <defs>
    <symbol id="icon-whatsapp" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12.04 2.1c-5.46 0-9.9 4.44-9.9 9.9 0 1.75.46 3.45 1.33 4.95L2 22l5.19-1.36a9.87 9.87 0 0 0 4.85 1.24h.01c5.46 0 9.9-4.44 9.9-9.9 0-2.64-1.03-5.13-2.9-7-1.87-1.87-4.36-2.88-7.01-2.88Zm0 18.13h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.08.81.82-3-.2-.31a8.2 8.2 0 0 1-1.26-4.4c0-4.55 3.7-8.25 8.25-8.25 2.2 0 4.27.86 5.83 2.42a8.2 8.2 0 0 1 2.41 5.83c0 4.55-3.71 8.23-8.27 8.23Zm4.52-6.17c-.25-.12-1.47-.72-1.7-.81-.23-.08-.39-.12-.56.13-.16.24-.64.81-.78.97-.14.16-.29.18-.53.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.01-.38.11-.5.11-.11.25-.29.37-.43.12-.15.16-.25.24-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.83-.2-.48-.41-.42-.56-.42h-.48c-.16 0-.42.06-.64.31-.22.25-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.7 2.6 4.13 3.64.58.25 1.03.4 1.38.51.58.18 1.11.16 1.53.1.47-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.22-.16-.47-.28Z"/>
    </symbol>
    <symbol id="icon-facebook" viewBox="0 0 24 24">
      <path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M14.5 8.5H13a1.5 1.5 0 0 0-1.5 1.5v2M11.5 12v7M9.5 12h4"/>
      <rect x="3" y="3" width="18" height="18" rx="4" fill="none" stroke="currentColor" stroke-width="1.6"/>
    </symbol>
    <symbol id="icon-x" viewBox="0 0 24 24">
      <path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" d="M5 5l14 14M19 5 5 19"/>
    </symbol>
    <symbol id="icon-instagram" viewBox="0 0 24 24">
      <rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="1.6"/>
      <circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.6"/>
      <circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" stroke="none"/>
    </symbol>
    <symbol id="icon-discord" viewBox="0 0 24 24">
      <path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M6.5 8.2C8 7.3 9.9 6.8 12 6.8s4 .5 5.5 1.4c1.2 2 1.8 4.3 1.7 7-1.5 1.1-3 1.7-4.4 2l-.7-1.3c.6-.2 1.2-.5 1.7-.9-.1-.1-.3-.2-.4-.3-2.5 1.1-5.2 1.1-7.7 0-.1.1-.3.2-.4.3.5.4 1.1.7 1.7.9L8.3 17c-1.5-.3-2.9-.9-4.4-2-.1-2.5.4-4.9 1.7-6.8Z"/>
      <circle cx="9.5" cy="12.3" r="1" fill="currentColor" stroke="none"/>
      <circle cx="14.5" cy="12.3" r="1" fill="currentColor" stroke="none"/>
    </symbol>
    <symbol id="icon-youtube" viewBox="0 0 24 24">
      <rect x="2.5" y="6" width="19" height="12" rx="3.5" fill="none" stroke="currentColor" stroke-width="1.6"/>
      <path fill="currentColor" stroke="none" d="M10.5 9.7v4.6l4-2.3-4-2.3Z"/>
    </symbol>
  </defs>
</svg>


<div class="topbar">
  <div class="wrap">
    <div class="topbar-links">
      <a href="https://wa.me/5491133972764" target="_blank" rel="noopener noreferrer"><svg class="icon-wsp-top"><use href="#icon-whatsapp"></use></svg>+54 11 3397-2764</a>
      <span class="sep">·</span>
      <a href="http://tcadmin.4evergaming.com.ar" target="_blank" rel="noopener noreferrer">TCAdmin</a>
      <span class="sep">·</span>
      <a href="https://clientes.4evergaming.com.ar" target="_blank" rel="noopener noreferrer">Área de clientes</a>
    </div>
    <div class="topbar-social">
      <a href="https://facebook.com/4evergaming.com.ar" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg class="icon-sm"><use href="#icon-facebook"></use></svg></a>
      <a href="https://twitter.com/4evergamingOK" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><svg class="icon-sm"><use href="#icon-x"></use></svg></a>
      <a href="https://instagram.com/4evergaming.com.ar" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><svg class="icon-sm"><use href="#icon-instagram"></use></svg></a>
      <a href="https://discord.gg/nc5dvgPqZ5" target="_blank" rel="noopener noreferrer" aria-label="Discord"><svg class="icon-sm"><use href="#icon-discord"></use></svg></a>
      <a href="https://www.youtube.com/channel/UCOGkRP2uNamUAsWnYUPd2xg" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><svg class="icon-sm"><use href="#icon-youtube"></use></svg></a>
    </div>
  </div>
</div>


<header class="site">
  <div class="wrap nav">
    <a href="#top" class="logo"><span class="dot"></span>4evergaming</a>
    <nav class="menu">
      <div class="menu-item"><a href="#games" class="menu-trigger">Game Hosting</a></div>
      <div class="menu-item"><a href="#vps" class="menu-trigger">VPS Hosting</a></div>
      <div class="menu-item"><a href="#web" class="menu-trigger">Web Hosting</a></div>
      <div class="menu-item"><a href="#why" class="menu-trigger">¿Por qué nosotros?</a></div>
      <div class="menu-item"><a href="#pagos" class="menu-trigger">Medios de pago</a></div>
    </nav>
    <div class="nav-actions">
      <a href="https://clientes.4evergaming.com.ar" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm client-area">Área de clientes</a>
      <a href="https://wa.me/5491133972764" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Contratar</a>
      <div class="burger"><span></span><span></span><span></span></div>
    </div>
  </div>
</header>


<section class="hero" id="top">
  <div class="wrap hero-grid">
    <div>
      <a href="https://4evergaming.com.ar/status" target="_blank" rel="noopener noreferrer" class="hero-tag"><span class="ping"></span>Servicios operativos</a>
      <h1>Servidores que<br>no le sueltan <span>tick</span> a nadie.</h1>
      <p class="lead">Alquiler de servidores para Counter-Strike, MTA, Minecraft y más de 15 juegos, además de VPS y Web Hosting. Activación automática, sin contratos, con protección anticheat y mitigación DDoS incluida.</p>
      <div class="hero-cta">
        <a href="#games" class="btn btn-primary">Ver servidores de juegos</a>
        <a href="https://wa.me/5491133972764" target="_blank" rel="noopener noreferrer" class="btn btn-ghost">Hablar por WhatsApp</a>
      </div>
      <div class="hero-stats">
        <div><b>+5.000</b><span>Clientes activos</span></div>
        <div><b>+20.000</b><span>Comunidades</span></div>
        <div><b>12+</b><span>Años de trayectoria</span></div>
        <div><b>99.74%</b><span>Uptime Tier II</span></div>
      </div>
    </div>
    <div class="terminal reveal" id="terminal">
      <div class="terminal-bar">
        <span></span><span></span><span></span>
        <div class="title">consola — 4evergaming</div>
      </div>
      <div class="terminal-body" id="terminalBody"></div>
    </div>
  </div>
</section>


<section class="feature-strip">
  <div class="wrap feature-grid">
    <div class="feature-card reveal">
      <div class="num">01 / SEGURIDAD</div>
      <h3>Anticheat + Anti-DDoS</h3>
      <p>Redes confiables sobre los carriers más importantes de la región, con mitigación de ataques activa las 24 horas.</p>
    </div>
    <div class="feature-card reveal">
      <div class="num">02 / FLEXIBILIDAD</div>
      <h3>Sin contratos</h3>
      <p>Facturación mensual, sin costos ocultos y sin compromisos. Cancelás cuando quieras.</p>
    </div>
    <div class="feature-card reveal">
      <div class="num">03 / ESCALA</div>
      <h3>Recursos sin límites</h3>
      <p>¿Tu comunidad creció? Te ayudamos a reconfigurar el servidor o migrarlo a otro hardware sin fricción.</p>
    </div>
    <div class="feature-card reveal">
      <div class="num">04 / CONTROL</div>
      <h3>Administración fácil</h3>
      <p>Instalación de plugins, mods y módulos con un click desde el panel, sin conocimientos técnicos.</p>
    </div>
  </div>
</section>


<section class="killfeed-section">
  <div class="killfeed-head">
    <div class="eyebrow">Actividad en vivo</div>
    <div class="count"><span class="mono">●</span> clientes contratando ahora</div>
  </div>
  <div class="killfeed-viewport">
    <div class="killfeed-track" id="killfeedTrack"></div>
  </div>
</section>


<section class="section" style="padding-bottom:40px;">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Game Tracker</div>
      <h2>Buscá nuevos servidores</h2>
      <p>¿Competitivo 5v5? ¿Práctica? ¿DM? ¿Retakes? ¿Duelos 1v1 y 2v2? ¿KZ? ¿Surf? Encontralos acá.</p>
    </div>
    <div class="tracker-grid">
      
      <a href="https://4evergaming.com.ar/servers/cs16" target="_blank" rel="noopener noreferrer" class="tracker-card reveal">
        <div class="glyph"> <img src="{{ asset('images/games-icons/counter-strike16.ico') }}"> </div>
        <h4>CS 1.6</h4><span>Ver servers</span>
      </a>
      <a href="https://4evergaming.com.ar/servers/cs2" target="_blank" rel="noopener noreferrer" class="tracker-card reveal">
        <div class="glyph"> <img src="{{ asset('images/games-icons/counter-strike-2.bmp') }}"> </div>
        <h4>Counter-Strike 2</h4><span>Ver servers</span>
      </a>
      <a href="https://4evergaming.com.ar/servers/mta" target="_blank" rel="noopener noreferrer" class="tracker-card reveal">
        <div class="glyph"> <img src="{{ asset('images/games-icons/multi-theft-auto.ico') }}"> </div>
        <h4>Multi Theft Auto</h4><span>Ver servers</span>
      </a>
      <a href="https://4evergaming.com.ar/servers/minecraft" target="_blank" rel="noopener noreferrer" class="tracker-card reveal">
        <div class="glyph"> <img src="{{ asset('images/games-icons/minecraft.ico') }}"> </div>
        <h4>Minecraft</h4><span>Ver servers</span>
      </a>
    </div>
    <div class="tracker-more reveal">
      <a href="https://4evergaming.com.ar/servers" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">Ver todos los servidores →</a>
    </div>
  </div>
</section>


<section class="section" id="games">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Game Hosting</div>
      <h2>Un servidor para cada comunidad</h2>
      <p>Más de 5.000 clientes ya administran su propio servidor con nosotros. Elegí el juego, configurá tu plan y activalo al instante.</p>
    </div>
    <div class="games-grid">
      <div class="game-card reveal">
        <span class="tag">1000 FPS</span>
        <h3>Counter-Strike 1.6</h3>
        <p>El shooter por equipos n° 1 del mundo. Anticheat, fast download y 0 loss, 0 choke.</p>
        <div class="price">Desde <b>${{ $dollar_price * 2 }}</b>/mes</div>
        <a href="https://4evergaming.com.ar/games/counter-strike" target="_blank" rel="noopener noreferrer" class="arrow">Ver planes →</a>
      </div>
      <div class="game-card reveal">
        <span class="tag">128 TICK</span>
        <h3>CS: Global Offensive</h3>
        <p>Servidores 128 tickrate con protección anticheat y mitigación DDoS incluida.</p>
        <div class="price">Desde <b>${{ $dollar_price * 2.40 }}</b>/mes</div>
        <a href="https://4evergaming.com.ar/games/counter-strike-global-offensive" target="_blank" rel="noopener noreferrer" class="arrow">Ver planes →</a>
      </div>
      <div class="game-card reveal">
        <h3>Counter-Strike 2</h3>
        <p>La nueva era de CS, con la misma infraestructura de baja latencia de siempre.</p>
        <div class="price">Desde <b>${{ $dollar_price * 4 }}</b>/mes</div>
        <a href="https://4evergaming.com.ar/games/counter-strike-2" target="_blank" rel="noopener noreferrer" class="arrow">Ver planes →</a>
      </div>
      <div class="game-card reveal">
        <h3>Multi Theft Auto</h3>
        <p>Recursos sin límites para comunidades de GTA que no dejan de crecer.</p>
        <div class="price">Desde <b>${{ $dollar_price * 4 }}</b>/mes</div>
        <a href="https://4evergaming.com.ar/games/multi-theft-auto" target="_blank" rel="noopener noreferrer" class="arrow">Ver planes →</a>
      </div>
      <div class="game-card reveal">
        <h3>San Andreas Multiplayer</h3>
        <p>Servidores SAMP listos para tu rol, DM o economía sin configuraciones complicadas.</p>
        <div class="price">Desde <b>${{ $dollar_price * 3 }}</b>/mes</div>
        <a href="https://clientes.4evergaming.com.ar/store/grand-theft-auto/san-andreas-multi-player-samp?currency=2" target="_blank" rel="noopener noreferrer" class="arrow">Ver planes →</a>
      </div>
      <div class="game-card reveal">
        <span class="tag">1 CLICK</span>
        <h3>Minecraft</h3>
        <p>Instalación de plugins y módulos con un click. Máximo control, cero restricciones.</p>
        <div class="price">Desde <b>${{ $dollar_price * 6 }}</b>/mes</div>
        <a href="https://clientes.4evergaming.com.ar/store/minecraft?currency=2" target="_blank" rel="noopener noreferrer" class="arrow">Ver planes →</a>
      </div>
    </div>
    <div class="more-games reveal">
      <span class="mono" style="color:var(--text-dimmer); font-size:12.5px; padding:8px 4px;">También alquilamos:</span>
      <a href="https://clientes.4evergaming.com.ar/store/half-life?currency=2" target="_blank" rel="noopener noreferrer">Half-Life</a>
      <a href="https://clientes.4evergaming.com.ar/store/call-of-duty?currency=2" target="_blank" rel="noopener noreferrer">Call of Duty</a>
      <a href="https://clientes.4evergaming.com.ar/store/battlefield?currency=2" target="_blank" rel="noopener noreferrer">Battlefield</a>
      <a href="https://clientes.4evergaming.com.ar/store/left-4-dead?currency=2" target="_blank" rel="noopener noreferrer">Left 4 Dead</a>
      <a href="https://clientes.4evergaming.com.ar/store/team-fortress?currency=2" target="_blank" rel="noopener noreferrer">Team Fortress</a>
      <a href="https://clientes.4evergaming.com.ar/store/killing-floor?currency=2" target="_blank" rel="noopener noreferrer">Killing Floor</a>
      <a href="https://clientes.4evergaming.com.ar/store/medal-of-honor?currency=2" target="_blank" rel="noopener noreferrer">Medal of Honor</a>
      <a href="https://clientes.4evergaming.com.ar/store/servidores-de-dragon-ball-z?currency=2" target="_blank" rel="noopener noreferrer">Dragon Ball Z</a>
      <a href="https://clientes.4evergaming.com.ar/store?currency=2" target="_blank" rel="noopener noreferrer" style="color:var(--red-bright); border-color:var(--red-dark);">Ver todos →</a>
    </div>
  </div>
</section>


<section class="section" id="vps" style="background:var(--bg-panel); border-top:1px solid var(--line); border-bottom:1px solid var(--line);">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Cloud VPS</div>
      <h2>Subite a la nube</h2>
      <p>Almacenamiento SSD NVMe, Linux o Windows, mitigación anti-DDoS y 100% configurable. Procesadores Intel Core i9 y memoria a 3200MHz en todos los planes.</p>
    </div>
    <div class="plans-grid">
      <div class="plan-card reveal">
        <div class="plan-name">VPS SSD Silver</div>
        <ul class="plan-specs">
          <li>CPU <b>1 Core</b></li>
          <li>RAM <b>1 GB</b></li>
          <li>Disco <b>50 GB SATA</b></li>
          <li>Ancho de banda <b>50 Mb</b></li>
        </ul>
        <div class="plan-price"><div class="now">${{ $dollar_price * 11 }} <span>ARS/mes</span></div></div>
        <div class="plan-actions">
          <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a>
          <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20informaci%C3%B3n%20sobre%20servidores%20VPS" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">WhatsApp</a>
        </div>
      </div>
      <div class="plan-card featured reveal">
        <div class="plan-name">VPS SSD Nova</div>
        <ul class="plan-specs">
          <li>CPU <b>2 Core</b></li>
          <li>RAM <b>2 GB</b></li>
          <li>Disco <b>75 GB NVMe</b></li>
          <li>Ancho de banda <b>50 Mb</b></li>
        </ul>
        <div class="plan-price"><div class="now">${{ $dollar_price * 19 }} <span>ARS/mes</span></div></div>
        <div class="plan-actions">
          <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a>
          <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20informaci%C3%B3n%20sobre%20servidores%20VPS" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">WhatsApp</a>
        </div>
      </div>
      <div class="plan-card reveal">
        <div class="plan-name">VPS SSD Master</div>
        <ul class="plan-specs">
          <li>CPU <b>2 Core</b></li>
          <li>RAM <b>4 GB</b></li>
          <li>Disco <b>100 GB NVMe</b></li>
          <li>Ancho de banda <b>100 Mb</b></li>
        </ul>
        <div class="plan-price"><div class="now">${{ $dollar_price * 28 }} <span>ARS/mes</span></div></div>
        <div class="plan-actions">
          <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a>
          <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20informaci%C3%B3n%20sobre%20servidores%20VPS" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">WhatsApp</a>
        </div>
      </div>
      <div class="plan-card reveal">
        <div class="plan-name">VPS SSD Guardian</div>
        <ul class="plan-specs">
          <li>CPU <b>4 Core</b></li>
          <li>RAM <b>6 GB</b></li>
          <li>Disco <b>100 GB NVMe</b></li>
          <li>Ancho de banda <b>100 Mb</b></li>
        </ul>
        <div class="plan-price"><div class="now">${{ $dollar_price * 42 }} <span>ARS/mes</span></div></div>
        <div class="plan-actions">
          <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a>
          <a href="https://wa.me/5491133972764?text=Hola!%20Vengo%20de%20su%20sitio%20y%20quiero%20informaci%C3%B3n%20sobre%20servidores%20VPS" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">WhatsApp</a>
        </div>
      </div>
    </div>
    <ul class="check-grid reveal">
      <li>Mitigación de ataques</li>
      <li>Soporte calificado x365</li>
      <li>Acceso y control total</li>
      <li>Redes de alta velocidad</li>
      <li>Administración remota</li>
      <li>Recursos sin límites</li>
      <li>Infraestructura sustentable</li>
      <li>Monitoreo y administración</li>
      <li>Uptime garantizado</li>
      <li>Datacenter World Class</li>
      <li>Proveedores certificados</li>
      <li>Transferencia ilimitada</li>
    </ul>
    <div class="custom-plan-cta reveal">
      <div><strong>¿Ningún plan se ajusta a vos?</strong><p>Armá tu VPS a medida, eligiendo cada recurso.</p></div>
      <a href="https://clientes.4evergaming.com.ar/store/servidores-virtuales/vps-ssd-personalizable?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Personalizar plan</a>
    </div>
  </div>
</section>


<section class="section" id="web">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Web Hosting</div>
      <h2>Alojá tu sitio web</h2>
      <p>SSL, bases de datos y correo incluido. Migración gratuita y asistida. Atención al cliente 24/7.</p>
    </div>
    <div class="plans-grid">
      <div class="plan-card reveal">
        <div class="plan-name">Alojamiento 5G</div>
        <ul class="plan-specs">
          <li>Disco <b>5 GB NVMe</b></li>
          <li>Transferencia <b>Ilimitada</b></li>
          <li>SSL <b>Incluido</b></li>
          <li>Bases de datos <b>Ilimitadas</b></li>
        </ul>
        <div class="plan-price"><div class="old">${{ $dollar_price * 6 }}</div><div class="now">${{ $dollar_price * 3 }} <span>ARS/mes</span></div></div>
        <div class="plan-actions"><a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a></div>
      </div>

      <div class="plan-card featured reveal">
        <div class="plan-name">Alojamiento 15G</div>
        <ul class="plan-specs">
          <li>Disco <b>15 GB NVMe</b></li>
          <li>Transferencia <b>Ilimitada</b></li>
          <li>SSL <b>Incluido</b></li>
          <li>Bases de datos <b>Ilimitadas</b></li>
        </ul>
        <div class="plan-price"><div class="now">$8.750 <span>ARS/mes</span></div></div>
        <div class="plan-actions"><a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a></div>
      </div>
      <div class="plan-card reveal">
        <div class="plan-name">Alojamiento 30G</div>
        <ul class="plan-specs">
          <li>Disco <b>30 GB NVMe</b></li>
          <li>Transferencia <b>Ilimitada</b></li>
          <li>SSL <b>Incluido</b></li>
          <li>Bases de datos <b>Ilimitadas</b></li>
        </ul>
        <div class="plan-price"><div class="now">$15.750 <span>ARS/mes</span></div></div>
        <div class="plan-actions"><a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a></div>
      </div>
      <div class="plan-card reveal">
        <div class="plan-name">Alojamiento 100G</div>
        <ul class="plan-specs">
          <li>Disco <b>100 GB NVMe</b></li>
          <li>Transferencia <b>Ilimitada</b></li>
          <li>SSL <b>Incluido</b></li>
          <li>Bases de datos <b>Ilimitadas</b></li>
        </ul>
        <div class="plan-price"><div class="now">$47.250 <span>ARS/mes</span></div></div>
        <div class="plan-actions"><a href="https://clientes.4evergaming.com.ar/store/alojamiento-web?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pedir ahora</a></div>
      </div>
    </div>
    <p class="reveal" style="text-align:center; margin-top:22px; font-size:13.5px; color:var(--text-dimmer);">
      También tenemos planes de 10G y 50G, y opciones premium si necesitás más recursos.
      <a href="https://clientes.4evergaming.com.ar/store/alojamiento-web-premium?currency=2" target="_blank" rel="noopener noreferrer" style="color:var(--red-bright);">Ver alojamiento premium →</a>
    </p>
  </div>
</section>


<section class="section" id="why" style="background:var(--bg-panel); border-top:1px solid var(--line); border-bottom:1px solid var(--line);">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">¿Por qué 4evergaming?</div>
      <h2>Con nosotros es más fácil administrar tu servidor</h2>
      <p>Vas a poder crear un servidor personalizado en pocos minutos, o alojar uno que ya tengas armado. Nos adaptamos a tu nivel de conocimiento y siempre vas a contar con alguien del otro lado.</p>
    </div>
    <div class="why-grid">
      <div class="why-card reveal">
        <div class="mark">
          <svg viewBox="0 0 24 24"><path d="M8 21h8M12 17v4M7 4h10v3a5 5 0 0 1-10 0V4Z"/><path d="M7 5H4.5A1.5 1.5 0 0 0 3 6.5v0A3.5 3.5 0 0 0 6.5 10H7M17 5h2.5A1.5 1.5 0 0 1 21 6.5v0A3.5 3.5 0 0 1 17.5 10H17"/></svg>
        </div>
        <h3>Más de 12 años de experiencia</h3>
        <p>Somos la empresa líder en la prestación de servidores de juegos en Argentina.</p>
      </div>
      <div class="why-card reveal">
        <div class="mark">
          <svg viewBox="0 0 24 24"><path d="M4 18v-6a8 8 0 0 1 16 0v6"/><rect x="2.5" y="14.5" width="4" height="6" rx="1.4"/><rect x="17.5" y="14.5" width="4" height="6" rx="1.4"/></svg>
        </div>
        <h3>Profesionales a tu lado, 24/7</h3>
        <p>Un gran equipo de expertos dispuestos a ayudarte en todo lo que necesites, en tu idioma.</p>
      </div>
      <div class="why-card reveal">
        <div class="mark">
          <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="6.5" rx="1.2"/><rect x="3" y="13.5" width="18" height="6.5" rx="1.2"/><circle cx="7" cy="7.25" r="0.9" style="fill:var(--red-bright); stroke:none;"/><circle cx="7" cy="16.75" r="0.9" style="fill:var(--red-bright); stroke:none;"/></svg>
        </div>
        <h3>Servidores World Class</h3>
        <p>Alojamiento de juegos en Argentina: rápido, seguro y con datacenters de primer nivel.</p>
      </div>
    </div>
  </div>
</section>


<section class="history">
  <div class="history-grid">
    <div class="history-item reveal">
      <div class="eyebrow">Nuestra visión</div>
      <h3>Impulsando<br>comunidades gaming</h3>
      <p>Desarrollamos soluciones de hosting combinando infraestructura de alto rendimiento con atención cercana y personalizada, para que administradores, creadores y jugadores se enfoquen en construir experiencias.</p>
    </div>
    <div class="history-item reveal">
      <div class="eyebrow">28/03/2020</div>
      <h3>+15.000<br>jugadores simultáneos</h3>
      <p>Récord histórico de usuarios conectados en simultáneo, soportando más de 10G de tráfico en pleno auge del gaming como forma de entretenimiento y conexión.</p>
    </div>
    <div class="history-item reveal">
      <div class="eyebrow">Reconocimiento</div>
      <h3>+20.000<br>comunidades nos eligen</h3>
      <p>Construimos relaciones duraderas adaptándonos a cada proyecto, reduciendo tiempos de respuesta y mejorando de forma continua, día tras día.</p>
    </div>
  </div>
</section>


<section class="section">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Comunidad</div>
      <h2>Miles de clientes, grandes relaciones</h2>
      <p>Comunidades que confían y crecen su servidor con 4evergaming.</p>
    </div>

    <div class="comm-grid reveal">
      @foreach ($communities as $community)
      <a href="{{ route('communities/show', ['slug' => $community->slug]) }}" target="_blank" rel="noopener noreferrer" class="comm-card">
	<div class=""> 
		<img src="{{ asset('storage/communities/' . $community->logo) }}?t={{ strtotime($community->updated_at) }}" alt="{{ $community->name }} Logo">
      	</div> 
	<span class="community-name">{{ $community->name }}</span>
      </a>
      @endforeach
    </div>

   <p class="reveal" style="text-align:center; margin-top:22px; font-size:13.5px; color:var(--text-dimmer);">
    ¿Tenés una comunidad y querés aparecer en nuestro listado?
    <a href="{{ route('communities/index') }}"
       target="_blank"
       rel="noopener noreferrer"
       style="color:var(--red-bright);">
        Agregá tu comunidad →
    </a>
   </p>

  </div>
</section>


<section class="section" style="background:var(--bg-panel); border-top:1px solid var(--line); border-bottom:1px solid var(--line);">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Enlaces de interés</div>
      <h2>Todo lo que necesitás, a un click</h2>
    </div>
    <div class="resources-grid">
      <div class="resource-card reveal">
        <h3>TCAdmin</h3>
        <p>Administrá tu servidor desde la web reduciendo cualquier acción a simples clicks.</p>
        <ul>
          <li>Instalación de plugins con un click</li>
          <li>Estadísticas en tiempo real</li>
          <li>Descargas rápidas</li>
          <li>Gestión de subusuarios</li>
        </ul>
        <div class="links">
          <a href="http://tcadmin.4evergaming.com.ar" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Ingresar</a>
          <a href="https://www.youtube.com/watch?v=--Ejk7Mq824" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">Tour virtual</a>
        </div>
      </div>
      <div class="resource-card reveal">
        <h3>Área de clientes</h3>
        <p>100% online. Gestioná todos tus servicios sin perder tu valioso tiempo.</p>
        <ul>
          <li>Activación automática</li>
          <li>Resumen de facturación</li>
          <li>Gestión de pagos</li>
          <li>Programa de afiliados</li>
        </ul>
        <div class="links">
          <a href="https://clientes.4evergaming.com.ar?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Ingresar</a>
          <a href="https://clientes.4evergaming.com.ar/affiliates.php?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">Afiliados</a>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section" id="pagos">
  <div class="wrap">
    <div class="section-head reveal">
      <div class="eyebrow">Medios de pago</div>
      <h2>Pagá como te resulte más cómodo</h2>
    </div>

<div class="pay-grid">
  <a href="{{ asset('transferencia-electronica-de-fondos.pdf') }}" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-solid fa-building-columns"></i>
    </div>
    <span class="label">Transferencia / CBU</span>
    <span class="disc">5% descuento</span>
  </a>

  <a href="https://clientes.4evergaming.com.ar/knowledgebase/20/Medios-de-pago.html" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-solid fa-wallet"></i>
    </div>
    <span class="label">Billeteras virtuales</span>
    <span class="disc">5% descuento</span>
  </a>

  <a href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c938084837e83a40183822347fc0318" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-solid fa-rotate"></i>
    </div>
    <span class="label">Débito automático</span>
    <span class="disc">10% descuento</span>
  </a>

  <a href="https://link.mercadopago.com.ar/4evergaming" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-regular fa-credit-card"></i>
    </div>
    <span class="label">Tarjeta débito / crédito</span>
  </a>

  <a href="https://link.mercadopago.com.ar/4evergaming" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-solid fa-money-bill-wave"></i>
    </div>
    <span class="label">PagoFácil / Rapipago</span>
  </a>

  <a href="{{ asset('qr-code-4evergaming.pdf') }}" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-solid fa-qrcode"></i>
    </div>
    <span class="label">Código QR</span>
    <span class="disc">5% descuento</span>
  </a>

  <a href="https://www.blockchain.com/btc/address/1BxrkKPuLTkYUAeMrxzLEKvr5MGFu3NLpU" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-brands fa-bitcoin"></i>
    </div>
    <span class="label">Bitcoin y stablecoins</span>
  </a>

  <a href="https://link.mercadopago.com.ar/4evergaming" target="_blank" rel="noopener noreferrer" class="pay-card reveal">
    <div class="logo-slot">
      <i class="fa-solid fa-hand-holding-dollar"></i>
    </div>
    <span class="label">MercadoPago</span>
  </a>

</div>
  </div>
</section>


<section class="cta-band">
  <h2>¿Listo para armar tu servidor?</h2>
  <p>Activación automática, sin contratos y soporte real los 365 días del año. Empezá en minutos.</p>
  <div class="hero-cta">
    <a href="https://clientes.4evergaming.com.ar?currency=2" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Ir al área de clientes</a>
    <a href="https://wa.me/5491133972764" target="_blank" rel="noopener noreferrer" class="btn btn-ghost">Hablar por WhatsApp</a>
  </div>
</section>


<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="#top" class="logo"><span class="dot"></span>4evergaming</a>
        <p>Servidores de juegos, VPS y Web Hosting en Argentina. Rápido, seguro y con soporte 365.</p>
        <div class="footer-social">
          <a href="https://facebook.com/4evergaming.com.ar" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg class="icon-sm"><use href="#icon-facebook"></use></svg></a>
          <a href="https://twitter.com/4evergamingOK" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><svg class="icon-sm"><use href="#icon-x"></use></svg></a>
          <a href="https://instagram.com/4evergaming.com.ar" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><svg class="icon-sm"><use href="#icon-instagram"></use></svg></a>
          <a href="https://discord.gg/nc5dvgPqZ5" target="_blank" rel="noopener noreferrer" aria-label="Discord"><svg class="icon-sm"><use href="#icon-discord"></use></svg></a>
        </div>
      </div>
      <div>
        <h4>Game Hosting</h4>
        <ul>
          <li><a href="https://4evergaming.com.ar/games/counter-strike" target="_blank" rel="noopener noreferrer">Counter-Strike</a></li>
          <li><a href="https://4evergaming.com.ar/games/multi-theft-auto" target="_blank" rel="noopener noreferrer">Multi Theft Auto</a></li>
          <li><a href="https://clientes.4evergaming.com.ar/store/minecraft?currency=2" target="_blank" rel="noopener noreferrer">Minecraft</a></li>
          <li><a href="https://clientes.4evergaming.com.ar/store?currency=2" target="_blank" rel="noopener noreferrer">Ver todos los juegos</a></li>
        </ul>
      </div>
      <div>
        <h4>Hosting</h4>
        <ul>
          <li><a href="#vps">Cloud VPS</a></li>
          <li><a href="#web">Web Hosting</a></li>
          <li><a href="https://clientes.4evergaming.com.ar/store/alojamiento-web-premium?currency=2" target="_blank" rel="noopener noreferrer">Hosting premium</a></li>
          <li><a href="http://tcadmin.4evergaming.com.ar" target="_blank" rel="noopener noreferrer">TCAdmin</a></li>
        </ul>
      </div>
      <div>
        <h4>Soporte</h4>
        <ul>
          <li><a href="https://wa.me/5491133972764" target="_blank" rel="noopener noreferrer">WhatsApp</a></li>
          <li><a href="tel:+5491133972764">+54 11 3397-2764</a></li>
          <li><a href="mailto:ventas@4evergaming.com.ar">ventas@4evergaming.com.ar</a></li>
          <li><a href="https://4evergaming.com.ar/status" target="_blank" rel="noopener noreferrer">Estado de servicios</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>Desarrollado por <a href="https://estudionobel.com.ar" target="_blank" rel="noopener noreferrer" style="color:var(--text-dim);">Estudio Nobel</a></span>
      <br />
      <span>© 2026 4evergaming. Todos los derechos reservados.</span> 
    </div>
  </div>
</footer>

<a href="https://wa.me/5491133972764" target="_blank" rel="noopener noreferrer" class="wsp-float" aria-label="Chatear por WhatsApp">
  <svg><use href="#icon-whatsapp"></use></svg>
</a>

<script>
  // Mobile burger -> toggle inline dropdown menu (simple)
  document.querySelector('.burger').addEventListener('click', function(){
    const menu = document.querySelector('nav.menu');
    const isOpen = menu.style.display === 'flex';
    menu.style.display = isOpen ? 'none' : 'flex';
    menu.style.flexDirection = 'column';
    menu.style.position = 'absolute';
    menu.style.top = '100%';
    menu.style.left = '0';
    menu.style.right = '0';
    menu.style.background = 'var(--bg-panel)';
    menu.style.borderTop = '1px solid var(--line)';
    menu.style.padding = '8px 0';
  });

  // Reveal on scroll
  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
  }, {threshold:0.12});
  revealEls.forEach(el=>io.observe(el));

  // Terminal typing animation
  const lines = [
    {t:'prompt', text:'$ '},
    {t:'cmd', text:'connect 4evergaming.com.ar:27015'},
  ];
  const body = document.getElementById('terminalBody');
  const scriptLines = [
    {cls:'l', prompt:'$ ', cmd:'connect 4evergaming.com.ar:27015'},
    {cls:'l dim', text:'Resolviendo host... OK'},
    {cls:'l ok', text:'✓ Conectado — CS 1.6 | 1000 FPS | 0 loss, 0 choke'},
    {cls:'l', prompt:'$ ', cmd:'status'},
    {cls:'l dim', text:'anticheat: activo   ddos-mitigation: activo'},
    {cls:'l dim', text:'uptime: 99.74%      soporte: 365 días/año'},
    {cls:'l ok', text:'✓ Servidor listo. Bienvenido a 4evergaming.'},
  ];
  let li = 0;
  function typeLine(){
    if(li >= scriptLines.length){
      setTimeout(()=>{ body.innerHTML=''; li=0; typeLine(); }, 2600);
      return;
    }
    const spec = scriptLines[li];
    const row = document.createElement('div');
    row.className = spec.cls;
    body.appendChild(row);
    let full = spec.prompt ? '<span class="prompt">'+spec.prompt+'</span><span class="cmd"></span>' : spec.text;
    if(spec.prompt){
      row.innerHTML = '<span class="prompt">'+spec.prompt+'</span><span class="cmd"></span><span class="caret"></span>';
      const cmdSpan = row.querySelector('.cmd');
      const caret = row.querySelector('.caret');
      let i = 0;
      const iv = setInterval(()=>{
        cmdSpan.textContent += spec.cmd[i];
        i++;
        if(i>=spec.cmd.length){ clearInterval(iv); caret.remove(); li++; setTimeout(typeLine, 380); }
      }, 28);
    } else {
      row.textContent = spec.text;
      li++;
      setTimeout(typeLine, 480);
    }
  }
  typeLine();

  // Killfeed data (from real recent activity)
  const feed = [
    @foreach ($last_orders as $last_order)
    ['{{ mb_convert_case(explode(" ", trim($last_order->firstname))[0], MB_CASE_TITLE, "UTF-8") }}', '{{ ucwords(strtolower($last_order->state)) }}', '{{ $last_order->product }}', '{{ $last_order->diff_minutes >= 1440 ? "hace " . ceil($last_order->diff_minutes / 1440) . " días" : ($last_order->diff_minutes >= 60 ? "hace " . ceil($last_order->diff_minutes / 60) . " horas" : "hace " . ceil($last_order->diff_minutes) . " minutos") }}'],
    @endforeach
  ];
  const track = document.getElementById('killfeedTrack');
  function renderFeed(){
    let html = '';
    feed.forEach(f=>{
      html += `<div class="kf-item"><span class="icon">▸</span><span><b>${f[0]}</b> de ${f[1]}</span><span class="item">compró <em>${f[2]}</em></span><span class="time">${f[3]}</span></div>`;
    });
    return html;
  }
  track.innerHTML = renderFeed() + renderFeed();
</script>

</body>
</html>
