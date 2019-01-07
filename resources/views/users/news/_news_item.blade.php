@if( Utl::isAdmin() || ( $news->user_id  ===  Auth::user()->id ) )
                          <tr>
                              <th class="date">{{ $news->created_at }}</th>
                              <td>{{ str_limit($news->title, 70) }}</td>
                              <td class="news-table__body">{{ str_limit($news->body, 200) }}</td>
                              <td class="btn-action">

                                  <div>
                                      <a href="{{ action('Users\NewsController@edit', ['id' => $news->id]) }}">編集</a>
                                  </div>
                                  <div class="l-mg-t">
                                      {{-- 松田変更ここから --}}
                                      {{-- <a class="btn-dell" href="{{ action('Users\NewsController@delete', ['id' => $news->id]) }}">削除</a> --}}
                                      {{-- <a href="javascript:void(0);" onclick="delconfirm('{{ action('Users\NewsController@delete', ['id' => $news->id]) }}'); return false;">削除</a> --}}
                                      {{ Utl::confirmATag('btn-dell', 'delcnf', action('Users\NewsController@delete', ['id' => $news->id]), '削除') }}
                                      {{-- 松田変更ここまで --}}
                                  </div>

                          </tr>
@endif
