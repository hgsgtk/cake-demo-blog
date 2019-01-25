- [ ] 記事詳細取得にて成功レスポンスが返却される
- [ ] 記事詳細取得にて存在するレコードの場合、記事情報が返却される
- [ ] 記事詳細取得にて存在しないレコードの場合、NotFoundが返却される

































仮実装
[
    'id' => 1,
    'user_id' => 1,
    'title' => 'First Article',
    'slug' => 'first',
    'body' => 'First Article Body',
    'published' => 1,
    'created' => '2018-01-07T15:47:01+00:00',
    'modified' => '2018-01-07T15:47:02+00:00',
]

// 仮実装を置き換える
$article = $this->Articles->findBySlug($slug)->first();
$article = $this->Articles->findBySlug($slug)->firstOrFail();
