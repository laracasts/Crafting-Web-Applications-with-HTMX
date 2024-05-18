<?php

namespace App;

enum InvoiceStatus: string
{
    case Approved = 'A';
    case Open = 'O';
    case Paid = 'P';
    case Rejected = 'R';
}
