<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Chat - ZHIB</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/moderator-chat.css') }}">
</head>
<body>

    <nav class="chat-navbar">
        <div class="nav-left">
            <a href="{{ url('/moderator/chat') }}" class="nav-item active">Chat</a>
            <a href="{{ url('/moderator/events') }}" class="nav-item">Events</a>
        </div>
        
        <div class="nav-center">
            <h1>KOMUNITAS DESAIN INDONESIA</h1>
        </div>

        <div class="nav-right">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </nav>

    <main class="chat-area">
        
        <div class="msg-row right">
            <div class="msg-bubble">
                <p>Halo suhu-suhu dan teman-teman semua 👋. Izin drop eksplorasi desain landing page buat portfolio nih. Temanya tentang Sustainable Energy. Minta feedback pedasnya dong, terutama soal typographic hierarchy-nya. Terasa agak cluttered nggak ya?</p>
            </div>
            <div class="accent-bar bar-black"></div>
            <div class="msg-avatar" onclick="openMenu(event, '{{ Auth::user()->name ?? 'Saya' }}')">
                <img src="{{ asset('image/download (13).jpg') }}" alt="Me">
            </div>
        </div>

        <div class="msg-row left">
            <div class="msg-avatar" onclick="openMenu(event, 'Rian')">
                <img src="{{ asset('image/download (16).jpg') }}" alt="Rian">
            </div>
            <div class="accent-bar bar-blue"></div>
            <div class="msg-bubble">
                <p>Wih, warnanya seger banget Mas Rian! Kombinasi teal sama off-white nya enak di mata.</p>
            </div>
        </div>

        <div class="msg-row left">
            <div class="msg-avatar" onclick="openMenu(event, 'Rian')">
                <img src="{{ asset('image/download (16).jpg') }}" alt="Rian">
            </div>
            <div class="accent-bar bar-blue"></div>
            <div class="msg-bubble">
                <p>Cakep Mas Rian. Sedikit masukan aja, itu leading (jarak antar baris) di bagian paragraf hero section kayaknya terlalu rapet deh. Coba dilonggarin dikit biar readability-nya naik, soalnya font-nya sans-serif geometris gitu agak capek bacanya kalau rapet.</p>
            </div>
        </div>

        <div class="msg-row right">
            <div class="msg-bubble">
                <p>Ah, noted Mas Budi! Pantesan rasanya ada yang ngeganjel pas dilihat di mobile view. Siap, otw revisi line-height.</p>
            </div>
            <div class="accent-bar bar-black"></div>
            <div class="msg-avatar" onclick="openMenu(event, '{{ Auth::user()->name ?? 'Saya' }}')">
                <img src="{{ asset('image/download (13).jpg') }}" alt="Me">
            </div>
        </div>

        <div class="msg-row left">
            <div class="msg-avatar" onclick="openMenu(event, 'Rian')">
                <img src="{{ asset('image/download (16).jpg') }}" alt="Rian">
            </div>
            <div class="accent-bar bar-blue"></div>
            <div class="msg-bubble">
                <p>Sama satu lagi bang, itu tombol CTA (Call to Action) 'Learn More'-nya mungkin bisa dibikin lebih kontras warnanya? Agak ketelen sama background foto panel suryanya.</p>
            </div>
        </div>

        <div class="msg-row right">
            <div class="msg-bubble">
                <p>Wah iya bener juga. Makasih insight-nya Mbak Siska, Mas Budi, Mas Dito! Langsung dieksekusi.</p>
            </div>
            <div class="accent-bar bar-black"></div>
            <div class="msg-avatar" onclick="openMenu(event, '{{ Auth::user()->name ?? 'Saya' }}')">
                <img src="{{ asset('image/download (13).jpg') }}" alt="Me">
            </div>
        </div>

        <div class="chat-footer-wrapper">
            <div class="loading-icon"></div>

            <div class="input-container">
                <input type="text" placeholder="Type a new message here">
                <div class="input-icons">
                    <button><i class="fa-solid fa-paperclip"></i></button>
                    <button><i class="fa-regular fa-face-smile"></i></button>
                    <button><i class="fa-regular fa-paper-plane"></i></button>
                </div>
            </div>
        </div>

    </main>

    <div id="userActionMenu" class="action-menu">
        <div class="menu-item" onclick="actionLihatProfil()">
            Lihat Profil
        </div>
        <div class="menu-item kick" onclick="actionKick()">
            Kick
        </div>
    </div>

    <script>
        const menu = document.getElementById('userActionMenu');
        let currentUser = '';

        function openMenu(e, name) {
            e.stopPropagation();
            currentUser = name;
            
            // Posisi menu mengikuti kursor mouse
            menu.style.top = e.clientY + 'px';
            menu.style.left = e.clientX + 'px';
            menu.style.display = 'block';
        }

        function actionLihatProfil() {
            // Nanti bisa diarahkan ke route profil user lain
            // window.location.href = "{{ url('/profile/user') }}/" + currentUser;
            alert("Melihat profil: " + currentUser);
            menu.style.display = 'none';
        }

        function actionKick() {
            if(confirm("Yakin ingin kick " + currentUser + " dari komunitas ini?")) {
                alert(currentUser + " berhasil di-kick.");
                // Disini nanti bisa tambah logic AJAX ke backend untuk kick member
            }
            menu.style.display = 'none';
        }

        // Tutup menu jika klik sembarang tempat
        document.addEventListener('click', () => {
            menu.style.display = 'none';
        });
    </script>

</body>
</html>