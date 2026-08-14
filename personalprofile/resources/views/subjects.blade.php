@extends('layouts.app')

@section('title', 'List of Subjects')

@section('content')
    <h1>List of Subjects for This Semester</h1>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>IT101</td>
                <td>Introduction to Computing</td>
            </tr>
            <tr>
                <td>IT102</td>
                <td>Object-Oriented Programming</td>
            </tr>
            <tr>
                <td>IT103</td>
                <td>Database Management Systems</td>
            </tr>
            <tr>
                <td>IT104</td>
                <td>Web Development</td>
            </tr>
            <tr>
                <td>IT105</td>
                <td>Networking</td>
            </tr>
        </tbody>
    </table>
@endsection
