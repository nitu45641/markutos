<?php
$settings = Markutos\Utils\Helper::instance()->get_member_options();
extract($settings);
?>
<div class="wrapper">
    <h1><?php esc_html_e("Settings","markutos");?></h1>
    <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
        <div class="field mb-1">
            <label class="f_bold"><?php esc_html_e("Team Member Name","markutos");?></label>
            <input type="text" name="team_member_name" value="<?php echo esc_html($team_member_name); ?>"/>
        </div>
        <div class="field mb-1">
            <label class="f_bold"><?php esc_html_e("Team Member Slug","markutos");?></label>
            <input type="text" name="team_slug" value="<?php echo esc_html($team_slug); ?>" />
        </div>
        <input type="hidden" name="action" value="team_member_settings">
        <button type="submit" class="button" name="manage_team_submit"><?php esc_html_e("Submit","markutos");?></button>
    </form>
</div>