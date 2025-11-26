 <script>
    function selectSafeBots() {
        const safeBots = <?php echo json_encode(asdrubal_get_safe_bots()); ?>;
        
        // Desmarca todos primero
        document.querySelectorAll('input[name="asdrubal_llm_selected_bots[]"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Marca solo los seguros
        safeBots.forEach(bot => {
            const checkbox = document.querySelector('input[name="asdrubal_llm_selected_bots[]"][value="' + bot + '"]');
            if (checkbox && !checkbox.disabled) {
                checkbox.checked = true;
            }
        });
    }
    </script>