package Util;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.BufferedInputStream;
import java.util.ArrayList;
import java.util.HashMap;

import DataStructures.DocFreqTuple;
import DataStructures.DocReference;
import DataStructures.InvertedIndexDic;

public class Util {
	public static int lineCount(String filename) throws IOException {
	    InputStream is = new BufferedInputStream(new FileInputStream(filename));
	    try {
	        byte[] c = new byte[1024];
	        int count = 0;
	        int readChars = 0;
	        boolean empty = true;
	        while ((readChars = is.read(c)) != -1) {
	            empty = false;
	            for (int i = 0; i < readChars; ++i) {
	                if (c[i] == '\n') {
	                    ++count;
	                }
	            }
	        }
	        return (count == 0 && !empty) ? 1 : count;
	    } finally {
	        is.close();
	    }
	}
	
	public static HashMap<String, Integer> getTermDic(String filename) throws IOException{
		HashMap<String, Integer> termMap = new HashMap<String, Integer>();
		FileReader input = new FileReader(filename);
        BufferedReader bufRead = new BufferedReader(input);	
        String line = bufRead.readLine();       
        while(line != null){
        	String[] splitResult = line.split(" ");
            termMap.put(splitResult[1], Integer.parseInt(splitResult[0].substring(0, splitResult[0].length()-1)));
            line = bufRead.readLine();
        }
        return termMap;
	}
	
	public static ArrayList<DocReference> parseReference(String fileName, HashMap<String, Integer> termDic) throws IOException{
		FileReader input = new FileReader(fileName);
        BufferedReader bufRead = new BufferedReader(input);	
        String line = bufRead.readLine(); 
        ArrayList<DocReference> result = new ArrayList<DocReference>();
        int total = 0;
        int lineCount = 0;
        while(line != null){
        	lineCount++;
        	String[] splitResult = line.split(", ");
        	int docID = Integer.parseInt(splitResult[0]);
        	int i = 2;
        	for(; i < splitResult.length; i++){
        		if(splitResult[i].charAt(0)>='0' && splitResult[i].charAt(0) <= '9'){
        			break;
        		}
        	}
        	int docLength = Integer.parseInt(splitResult[i]);
        	total += docLength;
        	ArrayList<Integer> topWords = new ArrayList<Integer>();
        	for(i = i+1; i < splitResult.length; i++){
        		Integer currentID = termDic.get(splitResult[i]);
        		if(currentID != null){
        			topWords.add(currentID);
        		}
        	}
        	DocReference current = new DocReference(docID, splitResult[1], docLength, topWords);
        	result.add(current);
            line = bufRead.readLine();
        }
        return result;
	}

	public static InvertedIndexDic parseInverted(String fileName, ArrayList<DocReference> docReference) throws IOException {
		FileReader input = new FileReader(fileName);
        BufferedReader bufRead = new BufferedReader(input);	
        String line = bufRead.readLine(); 
        InvertedIndexDic result = new InvertedIndexDic();
        ArrayList<DocFreqTuple> currentList = new ArrayList<DocFreqTuple>();
        int prev = 0;
        int lineCount = 0;
        while(line != null){
        	String[] splitResult = line.split(" ");
        	int docID = Integer.parseInt(splitResult[1]);
        	int termID = Integer.parseInt(splitResult[0]);
        	if(termID != prev){
        		result.map.put(prev, currentList);
        		currentList = new ArrayList<DocFreqTuple>();
        		prev = termID;
        	}
        	DocFreqTuple current = new DocFreqTuple(docID, Integer.parseInt(splitResult[2]), docReference.get(docID).docLength);
        	currentList.add(current);
            line = bufRead.readLine();
        	lineCount++;
        }
        return result;
	}
}
