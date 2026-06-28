<?php
defined('ABSPATH') || exit;

/* ── Custom Post Type: vi_project ─────────────────── */
function vakinvest_register_cpt() {
    $labels = [
        'name'               => 'Проекти',
        'singular_name'      => 'Проект',
        'add_new'            => 'Добави нов',
        'add_new_item'       => 'Добави нов проект',
        'edit_item'          => 'Редактирай проект',
        'new_item'           => 'Нов проект',
        'view_item'          => 'Виж проект',
        'search_items'       => 'Търси проекти',
        'not_found'          => 'Няма намерени проекти',
        'not_found_in_trash' => 'Няма проекти в кошчето',
        'menu_name'          => 'Проекти',
        'all_items'          => 'Всички проекти',
    ];

    register_post_type('vi_project', [
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => 'proekti',
        'rewrite'       => ['slug' => 'proekti', 'with_front' => false],
        'menu_icon'     => 'dashicons-building',
        'menu_position' => 5,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'vakinvest_register_cpt');

/* ── Taxonomy: project_category ───────────────────── */
function vakinvest_register_taxonomy() {
    $labels = [
        'name'              => 'Категории проекти',
        'singular_name'     => 'Категория',
        'search_items'      => 'Търси категории',
        'all_items'         => 'Всички категории',
        'edit_item'         => 'Редактирай категория',
        'update_item'       => 'Обнови категория',
        'add_new_item'      => 'Добави нова категория',
        'new_item_name'     => 'Нова категория',
        'menu_name'         => 'Категории',
    ];

    register_taxonomy('project_category', 'vi_project', [
        'labels'       => $labels,
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => ['slug' => 'kategoriya-proekt'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'vakinvest_register_taxonomy');

/* ── Meta boxes ───────────────────────────────────── */
function vakinvest_add_meta_boxes() {
    add_meta_box(
        'vi_project_details',
        'Детайли на проекта',
        'vakinvest_project_details_cb',
        'vi_project',
        'side',
        'high'
    );
    add_meta_box(
        'vi_project_gallery',
        'Допълнителна галерия',
        'vakinvest_project_gallery_cb',
        'vi_project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vakinvest_add_meta_boxes');

function vakinvest_project_details_cb($post) {
    wp_nonce_field('vi_save_project', 'vi_project_nonce');
    $year     = get_post_meta($post->ID, '_vi_year', true);
    $location = get_post_meta($post->ID, '_vi_location', true);
    $area     = get_post_meta($post->ID, '_vi_area', true);
    ?>
    <p style="margin-bottom:10px">
        <label for="vi_year" style="display:block;font-weight:600;margin-bottom:4px">Година на завършване</label>
        <input type="number" id="vi_year" name="vi_year"
               value="<?php echo esc_attr($year); ?>"
               style="width:100%" min="1990" max="2030" placeholder="<?php echo date('Y'); ?>">
    </p>
    <p style="margin-bottom:10px">
        <label for="vi_location" style="display:block;font-weight:600;margin-bottom:4px">Населено място / Град</label>
        <input type="text" id="vi_location" name="vi_location"
               value="<?php echo esc_attr($location); ?>"
               style="width:100%" placeholder="напр. гр. София">
    </p>
    <p>
        <label for="vi_area" style="display:block;font-weight:600;margin-bottom:4px">РЗП / Площ (по желание)</label>
        <input type="text" id="vi_area" name="vi_area"
               value="<?php echo esc_attr($area); ?>"
               style="width:100%" placeholder="напр. 450 м²">
    </p>
    <?php
}

function vakinvest_project_gallery_cb($post) {
    $raw_ids    = get_post_meta($post->ID, '_vi_gallery', true);
    $gallery_ids = is_array($raw_ids) ? $raw_ids : [];
    ?>
    <p style="color:#666;font-size:13px;margin-bottom:12px">
        Основното изображение се задава от "Изображение на публикацията" (вдясно).
        Тук добавете допълнителни снимки за галерията на проекта.
    </p>
    <div id="vi-gallery-preview" style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;min-height:40px">
        <?php foreach ($gallery_ids as $img_id) :
            $thumb = wp_get_attachment_image_src($img_id, 'thumbnail');
            if (!$thumb) continue; ?>
            <div class="vi-gallery-item" style="position:relative;display:inline-block">
                <img src="<?php echo esc_url($thumb[0]); ?>"
                     width="80" height="80"
                     style="object-fit:cover;border-radius:4px;border:2px solid #e0e0e0">
                <button type="button" class="vi-remove-img" data-id="<?php echo (int)$img_id; ?>"
                        style="position:absolute;top:-7px;right:-7px;background:#cc0000;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:13px;line-height:1;padding:0">×</button>
            </div>
        <?php endforeach; ?>
    </div>
    <input type="hidden" id="vi_gallery_ids" name="vi_gallery_ids"
           value="<?php echo esc_attr(implode(',', array_filter($gallery_ids))); ?>">
    <button type="button" id="vi-add-images" class="button">
        + Добави снимки от медийната библиотека
    </button>

    <script>
    jQuery(document).ready(function($) {
        var frame;

        $('#vi-add-images').on('click', function(e) {
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({
                title: 'Избери снимки за галерията',
                button: { text: 'Добави избраните' },
                multiple: true,
                library: { type: 'image' }
            });
            frame.on('select', function() {
                var selection = frame.state().get('selection');
                var ids = $('#vi_gallery_ids').val()
                    ? $('#vi_gallery_ids').val().split(',').filter(Boolean)
                    : [];

                selection.each(function(attachment) {
                    var id   = attachment.get('id');
                    var sizes = attachment.get('sizes') || {};
                    var thumb = sizes.thumbnail ? sizes.thumbnail.url : attachment.get('url');

                    if (ids.indexOf(String(id)) === -1) {
                        ids.push(id);
                        $('#vi-gallery-preview').append(
                            '<div class="vi-gallery-item" style="position:relative;display:inline-block">' +
                            '<img src="' + thumb + '" width="80" height="80" style="object-fit:cover;border-radius:4px;border:2px solid #e0e0e0">' +
                            '<button type="button" class="vi-remove-img" data-id="' + id + '"' +
                            ' style="position:absolute;top:-7px;right:-7px;background:#cc0000;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:13px;line-height:1;padding:0">×</button>' +
                            '</div>'
                        );
                    }
                });
                $('#vi_gallery_ids').val(ids.join(','));
            });
            frame.open();
        });

        $(document).on('click', '.vi-remove-img', function() {
            var id  = String($(this).data('id'));
            var ids = $('#vi_gallery_ids').val().split(',').filter(function(i) { return i && i !== id; });
            $('#vi_gallery_ids').val(ids.join(','));
            $(this).closest('.vi-gallery-item').remove();
        });
    });
    </script>
    <?php
}

/* ── Save meta ────────────────────────────────────── */
function vakinvest_save_project_meta($post_id) {
    if (!isset($_POST['vi_project_nonce'])) return;
    if (!wp_verify_nonce($_POST['vi_project_nonce'], 'vi_save_project')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['vi_year'])) {
        $year = (int) $_POST['vi_year'];
        update_post_meta($post_id, '_vi_year', $year ?: '');
    }
    if (isset($_POST['vi_location'])) {
        update_post_meta($post_id, '_vi_location', sanitize_text_field($_POST['vi_location']));
    }
    if (isset($_POST['vi_area'])) {
        update_post_meta($post_id, '_vi_area', sanitize_text_field($_POST['vi_area']));
    }
    if (isset($_POST['vi_gallery_ids'])) {
        $ids = array_values(array_filter(array_map('intval', explode(',', $_POST['vi_gallery_ids']))));
        update_post_meta($post_id, '_vi_gallery', $ids);
    }
}
add_action('save_post_vi_project', 'vakinvest_save_project_meta');

/* ── Helper: get project gallery image IDs ─────────── */
function vakinvest_get_gallery_ids($post_id) {
    $ids = get_post_meta($post_id, '_vi_gallery', true);
    if (!is_array($ids)) $ids = [];
    // Prepend the featured image if it exists
    $thumb_id = get_post_thumbnail_id($post_id);
    if ($thumb_id) {
        $ids = array_merge([$thumb_id], array_diff($ids, [$thumb_id]));
    }
    return array_filter($ids);
}
