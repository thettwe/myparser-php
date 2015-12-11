<?php

# MyanmarParser-PHP
# https://github.com/thettwe/myparser-php.git
# Dec 11 2015

# This library is free software; you can redistribute it and/or
# modify it under the terms of the GNU Lesser General Public
# License as published by the Free Software Foundation; either
# version 2.1 of the License, or (at your option) any later version.

# This library is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# Lesser General Public License for more details.

# You should have received a copy of the GNU Lesser General Public
# License along with this library; if not, write to the Free Software
# Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301
# USA


class MyParser
{
    const MY_SYLLABLE_UNKNOWN = 0;
    const MY_SYLLABLE_CONSONANT = 1;
	const MY_SYLLABLE_MEDIAL = 2;
	const MY_SYLLABLE_VOWEL = 3;
	const MY_SYLLABLE_TONE = 4;
	const MY_SYLLABLE_1039 = 5;
	const MY_SYLLABLE_103A = 6;
	const MY_SYLLABLE_NUMBER = 7;
	const MY_SYLLABLE_SECTION = 8;


    var $CHAR_PART = [];

    const MY_PAIR_ILLEGAL = 0; # illegal sequence
    const MY_PAIR_NO_BREAK = 1; # no break
    const MY_PAIR_SYL_BREAK = 2; # syllable break
    const MY_PAIR_WORD_BREAK = 3; # word break
    const MY_PAIR_PUNCTUATION = 4; # punctuation break
    const MY_PAIR_CONTEXT = 5; # needs further context analysis
    const MY_PAIR_EOL = 6; # end of line

    const LANG_MY = 0; #

    const MM_MAX_CONTEXT_LENGTH = 4;

    function __construct()
    {
        $this->CHAR_PART = [
        self::MY_SYLLABLE_CONSONANT,#1000; MYANMAR LETTER KA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1001; MYANMAR LETTER KHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1002; MYANMAR LETTER GA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1003; MYANMAR LETTER GHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1004; MYANMAR LETTER NGA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1005; MYANMAR LETTER CA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1006; MYANMAR LETTER CHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1007; MYANMAR LETTER JA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1008; MYANMAR LETTER JHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1009; MYANMAR LETTER NYA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#100A; MYANMAR LETTER NNYA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#100B; MYANMAR LETTER TTA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#100C; MYANMAR LETTER TTHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#100D; MYANMAR LETTER DDA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#100E; MYANMAR LETTER DDHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#100F; MYANMAR LETTER NNA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1010; MYANMAR LETTER TA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1011; MYANMAR LETTER THA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1012; MYANMAR LETTER DA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1013; MYANMAR LETTER DHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1014; MYANMAR LETTER NA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1015; MYANMAR LETTER PA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1016; MYANMAR LETTER PHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1017; MYANMAR LETTER BA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1018; MYANMAR LETTER BHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1019; MYANMAR LETTER MA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#101A; MYANMAR LETTER YA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#101B; MYANMAR LETTER RA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#101C; MYANMAR LETTER LA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#101D; MYANMAR LETTER WA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#101E; MYANMAR LETTER SA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#101F; MYANMAR LETTER HA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1020; MYANMAR LETTER LLA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1021; MYANMAR LETTER A;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1022; MYANMAR LETTER SHAN A;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1023; MYANMAR LETTER I;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1024; MYANMAR LETTER II;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1025; MYANMAR LETTER U;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1026; MYANMAR LETTER UU;Lo;0;L;1025 102E;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1027; MYANMAR LETTER E;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1028; MYANMAR LETTER MON E;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1029; MYANMAR LETTER O;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#102A; MYANMAR LETTER AU;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#102B; MYANMAR VOWEL SIGN TALL AA;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#102C; MYANMAR VOWEL SIGN AA;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#102D; MYANMAR VOWEL SIGN I;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#102E; MYANMAR VOWEL SIGN II;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#102F; MYANMAR VOWEL SIGN U;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1030; MYANMAR VOWEL SIGN UU;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1031; MYANMAR VOWEL SIGN E;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1032; MYANMAR VOWEL SIGN AI;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1033; MYANMAR VOWEL SIGN MON II;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1034; MYANMAR VOWEL SIGN MON O;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1035; MYANMAR VOWEL SIGN E ABOVE;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1036; MYANMAR SIGN ANUSVARA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#1037; MYANMAR SIGN DOT BELOW;Mn;7;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#1038; MYANMAR SIGN VISARGA;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_1039,#1039; MYANMAR SIGN VIRAMA;Mn;9;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_103A,#103A; MYANMAR SIGN ASAT;Mn;9;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#103B; MYANMAR CONSONANT SIGN MEDIAL YA;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#103C; MYANMAR CONSONANT SIGN MEDIAL RA;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#103D; MYANMAR CONSONANT SIGN MEDIAL WA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#103E; MYANMAR CONSONANT SIGN MEDIAL HA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#103F; MYANMAR LETTER GREAT SA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1040; MYANMAR DIGIT ZERO;Nd;0;L;;0;0;0;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1041; MYANMAR DIGIT ONE;Nd;0;L;;1;1;1;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1042; MYANMAR DIGIT TWO;Nd;0;L;;2;2;2;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1043; MYANMAR DIGIT THREE;Nd;0;L;;3;3;3;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1044; MYANMAR DIGIT FOUR;Nd;0;L;;4;4;4;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1045; MYANMAR DIGIT FIVE;Nd;0;L;;5;5;5;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1046; MYANMAR DIGIT SIX;Nd;0;L;;6;6;6;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1047; MYANMAR DIGIT SEVEN;Nd;0;L;;7;7;7;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1048; MYANMAR DIGIT EIGHT;Nd;0;L;;8;8;8;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1049; MYANMAR DIGIT NINE;Nd;0;L;;9;9;9;N;;;;;
		self::MY_SYLLABLE_SECTION,#104A; MYANMAR SIGN LITTLE SECTION;Po;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_SECTION,#104B; MYANMAR SIGN SECTION;Po;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#104C; MYANMAR SYMBOL LOCATIVE;Po;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#104D; MYANMAR SYMBOL COMPLETED;Po;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#104E; MYANMAR SYMBOL AFOREMENTIONED;Po;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#104F; MYANMAR SYMBOL GENITIVE;Po;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1050; MYANMAR LETTER SHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1051; MYANMAR LETTER SSA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1052; MYANMAR LETTER VOCALIC R;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1053; MYANMAR LETTER VOCALIC RR;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1054; MYANMAR LETTER VOCALIC L;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1055; MYANMAR LETTER VOCALIC LL;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1056; MYANMAR VOWEL SIGN VOCALIC R;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1057; MYANMAR VOWEL SIGN VOCALIC RR;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1058; MYANMAR VOWEL SIGN VOCALIC L;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1059; MYANMAR VOWEL SIGN VOCALIC LL;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#105A; MYANMAR LETTER MON NGA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#105B; MYANMAR LETTER MON JHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#105C; MYANMAR LETTER MON BBA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#105D; MYANMAR LETTER MON BBE;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#105E; MYANMAR CONSONANT SIGN MON MEDIAL NA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#105F; MYANMAR CONSONANT SIGN MON MEDIAL MA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#1060; MYANMAR CONSONANT SIGN MON MEDIAL LA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1061; MYANMAR LETTER SGAW KAREN SHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1062; MYANMAR VOWEL SIGN SGAW KAREN EU;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1063; MYANMAR TONE MARK SGAW KAREN HATHI;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1064; MYANMAR TONE MARK SGAW KAREN KE PHO;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1065; MYANMAR LETTER WESTERN PWO KAREN THA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1066; MYANMAR LETTER WESTERN PWO KAREN PWA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1067; MYANMAR VOWEL SIGN WESTERN PWO KAREN EU;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1068; MYANMAR VOWEL SIGN WESTERN PWO KAREN UE;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#1069; MYANMAR SIGN WESTERN PWO KAREN TONE-1;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#106A; MYANMAR SIGN WESTERN PWO KAREN TONE-2;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#106B; MYANMAR SIGN WESTERN PWO KAREN TONE-3;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#106C; MYANMAR SIGN WESTERN PWO KAREN TONE-4;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#106D; MYANMAR SIGN WESTERN PWO KAREN TONE-5;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#106E; MYANMAR LETTER EASTERN PWO KAREN NNA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#106F; MYANMAR LETTER EASTERN PWO KAREN YWA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1070; MYANMAR LETTER EASTERN PWO KAREN GHWA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1071; MYANMAR VOWEL SIGN GEBA KAREN I;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1072; MYANMAR VOWEL SIGN KAYAH OE;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1073; MYANMAR VOWEL SIGN KAYAH U;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1074; MYANMAR VOWEL SIGN KAYAH EE;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1075; MYANMAR LETTER SHAN  KA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1076; MYANMAR LETTER SHAN  KHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1077; MYANMAR LETTER SHAN  GA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1078; MYANMAR LETTER SHAN  CA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1079; MYANMAR LETTER SHAN  ZA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#107A; MYANMAR LETTER SHAN  NYA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#107B; MYANMAR LETTER SHAN  DA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#107C; MYANMAR LETTER SHAN  NA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#107D; MYANMAR LETTER SHAN  PHA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#107E; MYANMAR LETTER SHAN  FA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#107F; MYANMAR LETTER SHAN  BA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1080; MYANMAR LETTER SHAN  THA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#1081; MYANMAR LETTER SHAN  HA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_MEDIAL,#1082; MYANMAR CONSONANT SIGN SHAN  MEDIAL WA;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1083; MYANMAR VOWEL SIGN SHAN  AA;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1084; MYANMAR VOWEL SIGN SHAN  E;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1085; MYANMAR VOWEL SIGN SHAN E ABOVE;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_VOWEL,#1086; MYANMAR VOWEL SIGN SHAN  FINAL Y;Mn;0;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#1087; MYANMAR SIGN SHAN TONE-2;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#1088; MYANMAR SIGN SHAN TONE-3;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#1089; MYANMAR SIGN SHAN TONE-5;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#108A; MYANMAR SIGN SHAN TONE-6;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#108B; MYANMAR SIGN SHAN COUNCIL TONE-2;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#108C; MYANMAR SIGN SHAN COUNCIL TONE-3;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#108D; MYANMAR SIGN SHAN COUNCIL EMPHATIC TONE;Mn;220;NSM;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT,#108E; MYANMAR LETTER RUMAI PALAUNG FA;Lo;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_TONE,#108F; MYANMAR SIGN RUMAI PALAUNG TONE-5;Mc;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1090;  MYANMAR SHAN DIGIT ZERO;Nd;0;L;;0;0;0;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1091;  MYANMAR SHAN DIGIT ONE;Nd;0;L;;1;1;1;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1092;  MYANMAR SHAN DIGIT TWO;Nd;0;L;;2;2;2;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1093;  MYANMAR SHAN DIGIT THREE;Nd;0;L;;3;3;3;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1094;  MYANMAR SHAN DIGIT FOUR;Nd;0;L;;4;4;4;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1095;  MYANMAR SHAN DIGIT FIVE;Nd;0;L;;5;5;5;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1096;  MYANMAR SHAN DIGIT SIX;Nd;0;L;;6;6;6;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1097;  MYANMAR SHAN DIGIT SEVEN;Nd;0;L;;7;7;7;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1098;  MYANMAR SHAN DIGIT EIGHT;Nd;0;L;;8;8;8;N;;;;;
		self::MY_SYLLABLE_NUMBER,#1099;  MYANMAR SHAN DIGIT NINE;Nd;0;L;;9;9;9;N;;;;;
		self::MY_SYLLABLE_TONE,#109A
		self::MY_SYLLABLE_TONE,#109B
		self::MY_SYLLABLE_TONE,#109C
		self::MY_SYLLABLE_TONE,#109D??
		self::MY_SYLLABLE_CONSONANT,#109E; MYANMAR SYMBOL SHAN ONE;So;0;L;;;;;N;;;;;
		self::MY_SYLLABLE_CONSONANT#109F; MYANMAR SYMBOL SHAN EXCLAMATION;So;0;L;;;;;N;;;;;
		];
    }

    function get_char($srtingOrChar)
    {
        if (is_string($srtingOrChar)) {
			$char = $this->_uniord($srtingOrChar);
		}
		else
            $char = $srtingOrChar;

		return $char;
    }

    function get_char_class($string)
    {
        $identifiedClass = self::MY_SYLLABLE_UNKNOWN;
		$char = $this->get_char($string);

		if (0x1000 > $char || $char > 0x109F) {
            if (0xAA60 <= $char and $char < 0xAA7C) {
                if ($char == 0xAA70) {
                    return self::MY_SYLLABLE_TONE;
                }
                elseif ($char == 0xAA7B) {
                    return self::MY_SYLLABLE_TONE;
                }

                return self::MY_SYLLABLE_CONSONANT;
            }

            return self::MY_SYLLABLE_UNKNOWN;
        }

		$identifiedClass = $this->CHAR_PART[$char - 0x1000];
		return $identifiedClass;
    }

    function get_break_status($before, $after)
    {
        # first char = row, second char = column
        # 0=illegal, 1=no, 2=yes, 3=yes-line, 4=punctuation, 5=context,

        $BKSTATUS = [
            # -  C  M  V  T 39 3A  N  S
            [ 1, 3, 1, 1, 1, 1, 1, 1, 1 ],#-
			[ 3, 5, 1, 1, 1, 1, 1, 2, 4 ],#C
			[ 3, 5, 1, 1, 1, 0, 1, 2, 4 ],#M
			[ 3, 5, 0, 1, 1, 0, 1, 2, 4 ],#V
			[ 3, 2, 0, 1, 1, 0, 1, 2, 4 ],#T
			[ 3, 1, 0, 0, 0, 0, 0, 0, 0 ],#1039
			[ 3, 2, 1, 1, 1, 1, 0, 2, 4 ],#103A
			[ 3, 2, 1, 1, 1, 0, 0, 1, 4 ],#N
			[ 3, 2, 0, 0, 0, 0, 0, 2, 0 ] #S
		];

		$firstClass = $this->get_char_class($before);
		$secondClass = $this->get_char_class($after);

		# print firstClass, secondClass

		return $BKSTATUS[$firstClass][$secondClass];
    }

    function evaluate_context($contextText, $offset, $langHint)
    {
        $text = mb_substr($contextText, $offset);

		$length = mb_strlen($text);
		if ($length < 4) {
            $text = str_pad($text, 4);
        }

		$text0 = $this->_uniord(mb_substr($text, 0, 1));
		$text1 = $this->_uniord(mb_substr($text, 1, 1));
		$text2 = $this->_uniord(mb_substr($text, 2, 1));
		$text3 = $this->_uniord(mb_substr($text, 3, 1));

		if ($text0 == 0x1021 && $langHint == self::LANG_MY)
			return self::MY_PAIR_NO_BREAK;
		if ($text1 == 0x002D)
			return self::MY_PAIR_NO_BREAK;
        if ($text1 == 0x103F)
			return self::MY_PAIR_NO_BREAK;
		if ($text2 == 0x1037 && $text3 == 0x103A)
			return self::MY_PAIR_NO_BREAK;
		if ($text2 == 0x1039)
			return self::MY_PAIR_NO_BREAK;
		elseif ($text2 == 0x103A && $langHint == self::LANG_MY)
			# Karen (and also some loan words in Myanmar) can have a starting 103A
			return self::MY_PAIR_NO_BREAK;
		else
			return self::MY_PAIR_SYL_BREAK;
    }

	function _uniord($c) {
		if (ord($c{0}) >=0 && ord($c{0}) <= 127)
			return ord($c{0});
		if (ord($c{0}) >= 192 && ord($c{0}) <= 223)
			return (ord($c{0})-192)*64 + (ord($c{1})-128);
		if (ord($c{0}) >= 224 && ord($c{0}) <= 239)
			return (ord($c{0})-224)*4096 + (ord($c{1})-128)*64 + (ord($c{2})-128);
		if (ord($c{0}) >= 240 && ord($c{0}) <= 247)
			return (ord($c{0})-240)*262144 + (ord($c{1})-128)*4096 + (ord($c{2})-128)*64 + (ord($c{3})-128);
		if (ord($c{0}) >= 248 && ord($c{0}) <= 251)
			return (ord($c{0})-248)*16777216 + (ord($c{1})-128)*262144 + (ord($c{2})-128)*4096 + (ord($c{3})-128)*64 + (ord($c{4})-128);
		if (ord($c{0}) >= 252 && ord($c{0}) <= 253)
			return (ord($c{0})-252)*1073741824 + (ord($c{1})-128)*16777216 + (ord($c{2})-128)*262144 + (ord($c{3})-128)*4096 + (ord($c{4})-128)*64 + (ord($c{5})-128);
		if (ord($c{0}) >= 254 && ord($c{0}) <= 255)    //  error
			return FALSE;
		return 0;
	}   //  function

	function _unichr($o) {
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding('&#'.intval($o).';', 'UTF-8', 'HTML-ENTITIES');
		} else {
			return chr(intval($o));
		}
	}   // function _unichr()

    function get_next_syllable($text, $length, $offset)
    {
        # print "get_next_syllable",text[offset:]
        $breakType = self::MY_PAIR_NO_BREAK;
		$i = $offset;
		$foundCluster = False;
		if ($offset >= $length)
            return [$breakType, $length];
		while ($i + 1 < $length) {
            $breakStatus = $this->get_break_status(mb_substr($text, $i, 1), mb_substr($text, $i + 1, 1));
			if ($breakStatus == self::MY_PAIR_NO_BREAK) {

            }
            elseif ($breakStatus == self::MY_PAIR_SYL_BREAK || $breakStatus == self::MY_PAIR_WORD_BREAK || $breakStatus == self :: MY_PAIR_PUNCTUATION || $breakStatus == self :: MY_PAIR_ILLEGAL) {
                $breakType = $breakStatus;
				$foundCluster = True;
			}
            elseif ($breakStatus == self::MY_PAIR_CONTEXT) {
                $breakType = $this->evaluate_context($text, $i, self::LANG_MY);
				if ($breakType != self::MY_PAIR_NO_BREAK) {
                    $foundCluster = True;
                }
			}
            else {
                print ("Unexpected status" + $breakStatus);
            }

			if ($foundCluster){
                break;
            }

            $i += 1;
        }
		if ($i + 1 == mb_strlen($text)) {
            $breakType = self::MY_PAIR_EOL;
        }

		return [$breakType, $i + 1];
    }

    function is__char($string)
    {
        $char = $this->get_char($string);
		if ((0x1000 <= $char and $char <= 0x109f) or (0xaa60 <= $char and $char <= 0xaa7f))
			return True;
		return False;
    }

    function is_not_($string)
    {
        $char = $this->get_char($string);
        $charClass = $this->get_char_class($char);
		if ($charClass == MYC_OT or $charClass == MYC_RQ or $charClass == MYC_LQ or $charClass == MYC_SP)
            return true;
		return false;
    }

    function is_neutral($string)
    {
        $char = $this->get_char($string);
        $charClass = $this->get_char_class($char);
		if ($charClass == MYC_WJ or $charClass == MYC_RQ or $charClass == MYC_LQ or $charClass == MYC_SP or $charClass == MYC_NJ)
            return true;
		return false;
    }
}

?>
