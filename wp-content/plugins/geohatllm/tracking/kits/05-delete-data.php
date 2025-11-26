<h2><?php _e('Delete Records', 'geohatllm'); ?></h2>
<form method="post" id="geohatllm-clear-form">
    <?php wp_nonce_field('geohatllm_clear_visits', 'geohatllm_clear_nonce'); ?>
    <button type="button" id="geohatllm-clear-trigger" class="button button-secondary" style="background:#8d096c;color:white;border:none;margin-top:20px;">
        <?php _e('🧨 Delete all records', 'geohatllm'); ?>
    </button>
</form>

<div id="geohatllm-modal" style="
    display:none;
    position:fixed;
    top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.45);
    backdrop-filter:blur(2px);
    z-index:9999;
    align-items:center;
    justify-content:center;
">
  <div style="
    background:white;
    border-radius:12px;
    max-width:450px;
    width:90%;
    padding:25px;
    box-shadow:0 15px 30px rgba(0,0,0,0.2);
    text-align:center;
  ">
    <h3 style="margin-bottom:10px;color:#111;font-size:20px;"><?php _e('Are you completely sure?', 'geohatllm'); ?></h3>
    <p style="color:#444;margin-bottom:25px;">
      <?php 
      printf(
          __('This action will delete <strong>all records</strong> from the LLM visit tracking. The information cannot be recovered once deleted. We recommend <a href="#descargar-datos" style="color:blue;">downloading the information</a> before deleting the data.', 'geohatllm')
      );
      ?>
    </p>

    <div style="display:flex;justify-content:center;gap:15px;">
      <button id="geohatllm-confirm-delete" class="button button-primary" style="background:#b91c1c;border:none;"><?php _e('Yes, delete everything', 'geohatllm'); ?></button>
      <button id="geohatllm-cancel-delete" class="button button-secondary"><?php _e('Cancel', 'geohatllm'); ?></button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('geohatllm-modal');
    const openBtn = document.getElementById('geohatllm-clear-trigger');
    const cancelBtn = document.getElementById('geohatllm-cancel-delete');
    const confirmBtn = document.getElementById('geohatllm-confirm-delete');
    const form = document.getElementById('geohatllm-clear-form');

    openBtn.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    confirmBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        // 🔥 Double layer: second security confirmation
        if (confirm('<?php echo esc_js(__('⚠️ Final confirmation: Are you sure you want to delete all records?', 'geohatllm')); ?>')) {
            form.submit();
        }
    });

    // Close when clicking outside the modal
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
    });
});
</script>

    <?php
if (isset($_POST['geohatllm_clear_button']) || isset($_POST['geohatllm_clear_nonce'])) {
    if (check_admin_referer('geohatllm_clear_visits', 'geohatllm_clear_nonce')) {
        global $wpdb;
        $table = $wpdb->prefix . 'geohatllm_visits';
        $wpdb->query("DELETE FROM $table");
        echo '<div class="notice notice-success"><p>' . __('✅ Records deleted successfully.', 'geohatllm') . '</p></div>';
    }
}