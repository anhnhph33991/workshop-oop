@extends('layouts.master')

@section('title')
    Comments {{ $product["p_name"] }}
@endsection

@section('main')
    <div class="container margin_60_35">

        <form action="{{ routeClient("shop/{$product['p_slug']}/handle-comment") }}" method="post" class="row justify-content-center">
            <div class="col-lg-8">
                <div class="write_review">
                    <h1>Comment for: {{ $product['p_name'] }}</h1>
                    <div class="form-group mt-5">
                        <label>Your review</label>
                        <textarea class="form-control {{ isInvalid($_SESSION['errors']['content'] ?? null) }}" style="height: 180px;"
                                  placeholder="Write your review to help others learn about this online business"
                                  name="content"
                        ></textarea>
                        @isset($_SESSION['errors']['content'])
                            <div class="invalid-feedback">
                                {{ $_SESSION['errors']['content'] }}
                            </div>
                        @endisset
                    </div>
                    <button type="submit" class="btn_1">Submit review</button>
                </div>
            </div>
        </form>
        <!-- /row -->
    </div>
@endsection
