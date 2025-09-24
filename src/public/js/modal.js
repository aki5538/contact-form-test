document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal');
    const closeBtn = document.getElementById('modal-close');
    const deleteForm = document.getElementById('delete-form');

    if (!deleteForm) {
        console.warn('delete-form が見つかりませんでした');
    }

    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', function () {
            // ✅ モーダルにデータをセット
            document.getElementById('modal-name').textContent = this.dataset.name;
            document.getElementById('modal-gender').textContent = this.dataset.gender;
            document.getElementById('modal-email').textContent = this.dataset.email;
            document.getElementById('modal-phone').textContent = this.dataset.tel;
            document.getElementById('modal-address').textContent = this.dataset.address;
            document.getElementById('modal-type').textContent = this.dataset.category;
            document.getElementById('modal-detail').textContent = this.dataset.detail;

            // ✅ 削除フォームのアクションをセット
            deleteForm.action = `/admin/${this.dataset.id}`;

            // ✅ モーダル表示
            modal.classList.add('show');
        });
    });

    closeBtn.addEventListener('click', function () {
        console.log('×ボタン押された！');
        modal.classList.remove('show');
    });
});
