<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    {{-- <h1>Congratulations Your Tree get Planted</h1>
    <p>your email is {{$customer->email}}</p>
    <p>your tree_number is {{$tree_number}}</p>
    <p>your post_id is {!!$post!!}</p>
    <p>your gallery is {{$photo}}</p> --}}
    
    <div style="background-color: lightgray;" width="100%" class="wrapper">
        <table align="center" style="background-color: rgb(236, 233, 233);" width=50%>
            <tr>
                <td>
                    <table width="100%" style="text-align: center;">
                        <tr>
                            <td style="background-color: #1A935A;height: 60px;">
                               <h3>Plant Tree</h3>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%" style="text-align: center;">
                        <tr>
                            <td style="padding: 10px 50px 0px 50px;">
                                <h3>Hi {{$customer->first_name}} </h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 50px 10px 50px;">
                              <h5> {{$post->title}}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 50px 10px 50px;">
                              <p>{!!$post->content!!}</p> 
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    We Are Happy to Serve You
                                </p>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" style="text-align: center;">
                        <tr>
                            <td>
                                <table width="100%" style="border-top: 1px solid #bbb;">
                                    <tr>

                                    <tr>
                                        <td>
                                            <p>
                                                Plant Tree Team For Your Help <br>
                                                Planttree@gmail.com <br>
                                                +970542159683
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a style="text-decoration: none; color: black; letter-spacing: 1px;"
                                                href="#">Privacy policy
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>