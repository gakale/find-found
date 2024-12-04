@props(['url', 'title'])

<div class="flex space-x-3">
    <!-- Facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" 
       target="_blank" 
       class="social-button facebook"
       title="Partager sur Facebook">
        <i class="fab fa-facebook-f"></i>
    </a>

    <!-- Twitter -->
    <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($title) }}" 
       target="_blank" 
       class="social-button twitter"
       title="Partager sur Twitter">
        <i class="fab fa-twitter"></i>
    </a>

    <!-- WhatsApp -->
    <a href="https://wa.me/?text={{ urlencode($title . ' - ' . $url) }}" 
       target="_blank" 
       class="social-button whatsapp"
       title="Partager sur WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Telegram -->
    <a href="https://t.me/share/url?url={{ urlencode($url) }}&text={{ urlencode($title) }}" 
       target="_blank" 
       class="social-button telegram"
       title="Partager sur Telegram">
        <i class="fab fa-telegram-plane"></i>
    </a>
</div>

<style>
    .social-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 9999px;
        color: white;
        transition: all 0.2s;
    }
    .social-button:hover {
        transform: scale(1.1);
    }
    .social-button.facebook { background-color: #1877f2; }
    .social-button.twitter { background-color: #1da1f2; }
    .social-button.whatsapp { background-color: #25d366; }
    .social-button.telegram { background-color: #0088cc; }
</style>
