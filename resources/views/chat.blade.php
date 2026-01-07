<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Grup Chat - KOMUNITAS DESAIN INDONESIA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <header class="chat-header">
    <div class="header-left">
      <a href="{{ url('/chat') }}" class="header-link active">Chat</a>
      <a href="{{ url('/grup-event') }}" class="header-link">Events</a>
    </div>

    <div class="header-center">
      <h1>KOMUNITAS DESAIN INDONESIA</h1>
    </div>

    <div class="header-right">
      <div class="search-pill">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search">
      </div>
    </div>
  </header>

  <main class="chat-container">

    <div class="message incoming">
      <img src="{{ asset('image/img (9).jpg') }}" class="avatar" alt="User">
      <div class="bubble-wrapper">
        <div class="bubble">
          <p>Halo suhu-suhu dan teman-teman semua 👋. Izin drop eksplorasi desain landing page buat portfolio nih. Temanya tentang Sustainable Energy. Minta feedback pedasnya dong, terutama soal typographic hierarchy-nya. Terasa agak cluttered nggak ya?</p>
        </div>
      </div>
    </div>

    <div class="message outgoing">
      <div class="bubble-wrapper">
        <div class="bubble">
          <p>Wih, warnanya seger banget Mas Rian! Kombinasi teal sama off-white nya enak di mata.</p>
        </div>
      </div>
      <img src="{{ asset('image/download (13).jpg') }}" class="avatar" alt="Me">
    </div>

    <div class="message outgoing">
      <div class="bubble-wrapper">
        <div class="bubble">
          <p>Cakep Mas Rian. Sedikit masukan aja, itu leading (jarak antar baris) di bagian paragraf hero section kayaknya terlalu rapet deh. Coba dilonggarin dikit biar readability-nya naik, soalnya font-nya sans-serif geometris gitu agak capek bacanya kalau rapet.</p>
        </div>
      </div>
      <img src="{{ asset('image/download (13).jpg') }}" class="avatar" alt="Me">
    </div>

    <div class="message incoming">
      <img src="{{ asset('image/img (9).jpg') }}" class="avatar" alt="User">
      <div class="bubble-wrapper">
        <div class="bubble">
          <p>Ah, noted Mas Budi! Pantesan rasanya ada yang ngeganjel pas dilihat di mobile view. Siap, otw revisi line-height.</p>
        </div>
      </div>
    </div>

    <div class="message outgoing">
      <div class="bubble-wrapper">
        <div class="bubble">
          <p>Sama satu lagi bang, itu tombol CTA (Call to Action) 'Learn More'-nya mungkin bisa dibikin lebih kontras warnanya? Agak ketelen sama background foto panel suryanya.</p>
        </div>
      </div>
      <img src="{{ asset('image/download (13).jpg') }}" class="avatar" alt="Me">
    </div>

    <div class="message incoming">
      <img src="{{ asset('image/img (9).jpg') }}" class="avatar" alt="User">
      <div class="bubble-wrapper">
        <div class="bubble">
          <p>Wah iya bener juga. Makasih insight-nya Mbak Siska, Mas Budi, Mas Dito! Langsung dieksekusi.</p>
        </div>
      </div>
    </div>
    
    <div style="height: 100px;"></div>

  </main>

  <footer class="chat-input-area">
    <button class="btn-refresh">
      <i class="fa-solid fa-rotate-right"></i>
    </button>

    <div class="input-box">
      <input type="text" placeholder="Type a new message here">
      
      <div class="input-actions">
        <button><i class="fa-solid fa-paperclip"></i></button>
        <button><i class="fa-regular fa-face-smile"></i></button>
        <button class="btn-send"><i class="fa-regular fa-paper-plane"></i></button>
      </div>
    </div>
  </footer>

</body>
</html>